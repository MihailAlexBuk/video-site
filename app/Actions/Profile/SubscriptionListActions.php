<?php

namespace App\Actions\Profile;

use App\Models\User;
use App\Models\Video;
use Illuminate\Support\Facades\Auth;

class SubscriptionListActions
{
    public function index(){
        $user = User::where('id', Auth::id())->first();
        $output = [];
        foreach ($user->follows as $sub){
            array_push($output, [
                'user' => User::where('id', $sub['id'])->first(),
                'videos' => Video::query()->where('user_id', $sub['id'])->orderByDesc('created_at')->take(4)->get()
            ]);
        }
        return $output;
    }

}
