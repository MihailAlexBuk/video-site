<?php

namespace App\Http\Controllers\Components;

use App\Actions\Components\FollowerActions;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    public function follow($id)
    {
        $resp = FollowerActions::follow($id);
        return $resp;
    }

    public function unfollow($id)
    {
        $resp = FollowerActions::unfollow($id);
        return $resp;
    }

    public function markAsRead(Request $request)
    {
        FollowerActions::markAsRead($request);
    }

    public function markAsReadAll()
    {
        FollowerActions::markAsReadAll();
    }




}
