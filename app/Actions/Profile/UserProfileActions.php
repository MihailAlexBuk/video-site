<?php

namespace App\Actions\Profile;

use App\Models\LikeDislike;
use App\Models\Video;
use App\Models\VideoView;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserProfileActions
{
    public function index(){
        $video = LikeDislike::where('user_id', Auth::id())->where('like', 1)->select('video_id')->get();
        $videos = Video::whereIn('id', $video)->get();

        return $videos;
    }

    public function most_popular($id){
        $most_popular = LikeDislike::query()
            ->groupBy('video_id')
            ->whereHas('videos', function ($query) use ($id){
                return $query->where('user_id', $id);
            })
            ->selectRaw('sum(`like`) as total_likes, video_id')
            ->orderByDesc('total_likes')
            ->pluck('total_likes', 'video_id')
            ->take(4);

        $most_popular_video = [];
        foreach ($most_popular as $k => $v){array_push($most_popular_video, $k);}
        $most_popular_video = Video::whereIn('id', $most_popular_video)->get();

        return $most_popular_video;
    }

    public function most_view($id){
        $most_views = VideoView::query()
            ->groupBy('video_id')
            ->whereHas('videos', function ($query) use ($id){
                return $query->where('user_id', $id);
            })
            ->selectRaw('COUNT("video_id") as video, video_id')
            ->orderByDesc('video')
            ->pluck('video', 'video_id')
            ->take(4);

        $most_views_video = [];
        foreach ($most_views as $k => $v){array_push($most_views_video, $k);}
        $most_views_video = Video::whereIn('id', $most_views_video)->get();

        return $most_views_video;
    }

    public function viewsPerMonth(){
        $views = VideoView::query()->whereHas('videos', function ($query){
            return $query->where('user_id', Auth::id());
        })
            ->whereYear('created_at', now()->year)
            ->orWhere(function ($query) {
                $query->whereYear('created_at', now()->subYear()->year);
            })
            ->select('id', 'created_at')
            ->oldest()
            ->get()->groupBy(function ($data){
                return Carbon::parse($data->created_at)->format('M-Y');
            });
        $view_months = [];
        $view_monthCount = [];
        foreach ($views as $month => $val) {
            $view_months[] = $month;
            $view_monthCount[] = count($val);
        }
        return ['view_months' => $view_months, 'view_monthCount' => $view_monthCount];
    }

    public function likesPerMonth(){
        $likes = LikeDislike::query()
            ->whereHas('videos', function ($query){
                return $query->where('user_id', Auth::id());
            })
            ->whereYear('created_at', now()->year)
            ->orWhere(function ($query) {
                $query->whereYear('created_at', now()->subYear()->year);
            })
            ->groupBy('created_at')
            ->selectRaw('sum(`like`), created_at')
            ->oldest()
            ->get()->groupBy(function ($data){
                return Carbon::parse($data->created_at)->format('M-Y');
            });
        $like_months = [];
        $like_monthCount = [];
        foreach ($likes as $month => $val) {
            $like_months[] = $month;
            $like_monthCount[] = count($val);
        }

        return ['like_months' => $like_months, 'like_monthCount' => $like_monthCount];
    }

    public function newUsersPerMonth(){
        $subscriptions = DB::table('followers')
            ->where('user_id', Auth::id())
            ->whereYear('created_at', now()->year)
            ->orWhere(function ($query) {
                $query->whereYear('created_at', now()->subYear()->year);
            })
            ->select('id', 'created_at')
            ->oldest()
            ->get()->groupBy(function ($data){
                return Carbon::parse($data->created_at)->format('M-Y');
            });
        $subscription_months = [];
        $subscription_monthCount = [];
        foreach ($subscriptions as $month => $val) {
            $subscription_months[] = $month;
            $subscription_monthCount[] = count($val);
        }

        return ['subscription_months' => $subscription_months, 'subscription_monthCount' => $subscription_monthCount];
    }

}
