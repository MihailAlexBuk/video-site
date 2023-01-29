<?php

namespace App\Http\Controllers\Profile;

use App\Actions\Profile\LikedListActions;
use App\Http\Controllers\Controller;
use App\Models\LikeDislike;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikedListController extends Controller
{
    public function index(){
        $videos = LikedListActions::index();

        return view('profile.likedlist', compact('videos'));
    }
}
