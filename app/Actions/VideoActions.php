<?php

namespace App\Actions;

use App\Http\Requests\Video\StoreRequest;
use App\Models\LikeDislike;
use App\Models\Video;
use App\Models\VideoView;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class VideoActions
{
    public function index(){
        $videos = Video::where('user_id', Auth::id())->orderByDesc('created_at')->get();

        return $videos;
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        $data['poster'] = Storage::disk('public')->put('/images', $data['poster']);
        $data['video_url'] = Storage::disk('public')->put('/video', $data['video_url']);

        $tagIds = $data['tag_ids'];
        unset($data['tag_ids']);

        $video = new Video();
        $video['title'] = $data['title'];
        $video['desc'] = $data['desc'];
        $video['poster'] = $data['poster'];
        $video['video_url'] = $data['video_url'];
        $video['category_id'] = $data['category_id'];
        $video['user_id'] = Auth::id();
        $video->save();

        $video->tags()->attach($tagIds);
    }

    public function show($id)
    {
        $video = Video::where('id', $id)
            ->with('comments.replies', 'comments.user:id,name,avatar', 'comments.replies.user:id,name,avatar')
            ->first();

        $most_popular = LikeDislike::query()
            ->groupBy('video_id')
            ->selectRaw('sum(`like`) as total_likes, video_id')
            ->orderByDesc('total_likes')
            ->pluck('total_likes', 'video_id')
            ->take(30);

        $recommendations = [];
        foreach ($most_popular as $k => $v){array_push($recommendations, $k);}
        $recommendations = Video::whereIn('id', $recommendations)->get();

        $cheked = VideoView::query()
            ->where('video_id', $video->id)
            ->where('user_id', Auth::id())
            ->exists();

        $date = Carbon::parse($video->created_at)->diffForHumans();
        $view = view('watch', compact('video',  'recommendations', 'date'));

        if($cheked){
            return $view;
        }else{
            VideoView::createViewLog($video);
            return $view;
        }
    }

    public function update($request, $id)
    {
        $data = $request->validated();

        $video = Video::find($id);
        $video['title'] = $data['title'];
        $video['desc'] = $data['desc'];
        if(isset($data['poster'])){
            $data['poster'] = Storage::disk('public')->put('/images', $data['poster']);
            $video['poster'] = $data['poster'];
        }
        $video['category_id'] = $data['category_id'];
        $video['user_id'] = Auth::id();
        $video->update();

        if(isset($data['tag_ids'])){
            $tagIds = $data['tag_ids'];
            unset($data['tag_ids']);
            $video->tags()->attach($tagIds);
        }
    }

    public function save_likedislike(Request $request){

        if(LikeDislike::query()
            ->where('user_id', Auth::id())
            ->where('video_id', $request->video)
            ->exists())
        {
            return response()->json([
                'bool' => false
            ]);
        }else{
            $data = new LikeDislike;
            $data->video_id = $request->video;
            if($request->type == 'like'){
                $data->like = 1;
            }else{
                $data->dislike = 1;
            }
            $data->user_id = Auth::id();
            $data->save();
            return response()->json([
                'bool' => true
            ]);
        }
    }

    public function check_likedislike(Request $request){

        $check = LikeDislike::query()->where('user_id', Auth::id())->where('video_id', $request->video);
        if($check->exists())
        {
            if($check->first()->like === 1){
                return response()->json(['result' => 'like']);
            }else{
                return response()->json(['result' => 'dislike']);
            }
        }
    }
}
