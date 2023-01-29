<?php

namespace App\Actions\Components;

use App\Models\User;
use App\Models\Video;
use App\Notifications\UserFollowed;
use Illuminate\Http\Request;

class FollowerActions
{
    public function follow($id)
    {
        $user = User::where('id', $id)->first();
        $follower = auth()->user();
        if ( ! $follower->isFollowing($user->id)) {
            $follower->follow($user->id);

            $user->notify(new UserFollowed($follower));

            return back()->withSuccess("You are now friends with {$user->name}");
        }
        return back()->withSuccess("You are already following {$user->name}");
    }

    public function unfollow($id)
    {
        $user = User::where('id', $id)->first();
        $follower = auth()->user();
        if($follower->isFollowing($user->id)) {
            $follower->unfollow($user->id);
            return back()->withSuccess("You are no longer friends with {$user->name}");
        }
        return back()->withError("You are not following {$user->name}");
    }

    public function markAsRead(Request $request)
    {
        if($request['id']){
            auth()->user()->unreadNotifications->where('id', $request['id'])->markAsRead();
        }
    }

    public function markAsReadAll()
    {
        auth()->user()->unreadNotifications->markAsRead();
    }


}
