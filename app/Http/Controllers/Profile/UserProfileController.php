<?php

namespace App\Http\Controllers\Profile;

use App\Actions\Profile\UserProfileActions;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Video;

class UserProfileController extends Controller
{
    public function index($id){
        $user = User::where('id', $id)->first();

        $all_videos = Video::query()
            ->where('user_id', $id)
            ->orderByDesc('created_at')
            ->get();

        $most_popular_video = UserProfileActions::most_popular($id);
        $most_views_video = UserProfileActions::most_view($id);

        $views_per_month = UserProfileActions::viewsPerMonth();
        $likes_per_month = UserProfileActions::likesPerMonth();
        $subscriptions_per_month = UserProfileActions::newUsersPerMonth();

        return view('profile.profile', compact('user',
              'views_per_month',
            'likes_per_month',
            'subscriptions_per_month',
            'all_videos', 'most_popular_video',
            'most_views_video'));
    }
}
