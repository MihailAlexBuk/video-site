<?php

namespace App\Actions\Profile;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SettingsActions
{

    public function updateUserData(UpdateUserRequest $request){
        $data = $request->validated();
        $user = User::where('id', Auth::id())->first();
        if($data['new_password'] !== null || $data['new_password_confirmation'] !== null || $data['old_password'] !== null){
            if($data['new_password'] === $data['new_password_confirmation']){
                if(Hash::check($data['old_password'], $user->password)){
                    $user->password = Hash::make($data['new_password']);
                    $user->update();
                }else{
                    return back()->withError('The old password was entered incorrectly ')->withInput();
                }
            }else{
                return back()->withError('Passwords do not match ')->withInput();
            }
        }

        if($data['name'] !== null){
            $user->name = $data['name'];
            $user->update();
        }

        if($data['desc'] !== null){
            $user->desc = $data['desc'];
            $user->update();
        }

        if(isset($data['avatar'])){
            $data['avatar'] = Storage::disk('public')->put('/images', $data['avatar']);
            $user->avatar = $data['avatar'];
            $user->update();
        }

        return redirect()->route('settings')->with('status', 'Profile updated!');
    }

}
