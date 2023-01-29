<?php

namespace App\Actions\Profile;

use App\Models\LikeDislike;
use App\Models\Video;
use Illuminate\Support\Facades\Auth;

class LikedListActions
{
    public function index(){
        $video = LikeDislike::where('user_id', Auth::id())->where('like', 1)->select('video_id')->get();
        $videos = Video::whereIn('id', $video)->get();

        return $videos;
    }

}
