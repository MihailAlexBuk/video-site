<?php

namespace App\Http\Controllers\Profile;


use App\Actions\Profile\SettingsActions;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{

    public function settings(){
        $user = Auth::user();
        return view('profile.settings', compact('user'));
    }

    public function updateUserData(UpdateUserRequest $request){
        $resp = SettingsActions::updateUserData($request);
        return $resp;
    }
}
