<?php

namespace App\Http\Controllers;

use App\Actions\VideoActions;
use App\Http\Requests\Video\StoreRequest;
use App\Http\Requests\Video\UpdateRequest;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{

    public function index()
    {
        $videos = VideoActions::index();
        return view('video.index', compact('videos'));
    }

    public function create()
    {
        $tags = Tag::all();
        $categories = Category::all();
        return view('video.create', compact('tags', 'categories'));
    }

    public function store(StoreRequest $request)
    {
        VideoActions::store($request);

        return redirect()->route('videos.index');
    }

    public function show($id)
    {
        $view = VideoActions::show($id);
        return $view;
    }

    public function edit($id)
    {
        $video = Video::where('id', $id)->first();
        $categories = Category::all();
        $tags = Tag::all();
        return view('video.edit', compact('video', 'categories', 'tags'));
    }

    public function update(UpdateRequest $request, $id)
    {
        try{
            VideoActions::update($request, $id);

            return redirect()->route('videos.index');
        }catch (\Exception $e){
            return $e;
        }
    }

    public function destroy(Video $video)
    {
        $video->delete();
        return redirect()->route('videos.index');
    }

    public function save_likedislike(Request $request){
        $resp = VideoActions::save_likedislike($request);
        return $resp;
    }

    public function check_likedislike(Request $request){

        $resp = VideoActions::check_likedislike($request);
        return $resp;
    }
}
