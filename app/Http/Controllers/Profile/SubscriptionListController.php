<?php

namespace App\Http\Controllers\Profile;

use App\Actions\Profile\SubscriptionListActions;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionListController extends Controller
{
    public function index(){
        $output = SubscriptionListActions::index();
        return view('profile.subscriptions', compact('output'));
    }
}
