<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class VideoView extends Model
{
    use HasFactory;

    public static function createViewLog($video) {
        $videosViews= new VideoView();
        $videosViews->video_id = $video->id;
        $videosViews->url = Request::url();
        $videosViews->session_id = Request::getSession()->getId();
        $videosViews->user_id = Auth::id();
        $videosViews->ip = Request::getClientIp();
        $videosViews->agent = Request::header('User-Agent');
        $videosViews->save();
    }

    public function videos(){
        return $this->belongsTo(Video::class, 'video_id', 'id');
    }
}
