<?php
namespace App\Observers;
use App\Models\Video;
use App\Notifications\NewVideo;

class VideoObserver
{
    public function created($video){
//        $video = Video::where('id', $video_id)->first();
        $user = $video->user;
        foreach ($user->followers as $follower) {
            $follower->notify(new NewVideo($user, $video));
        }
    }
}
