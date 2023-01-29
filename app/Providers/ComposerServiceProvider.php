<?php

namespace App\Providers;

use App\Models\Video;
use App\Observers\VideoObserver;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function($view){
            if(Auth::check()){
                $unread_notif = auth()->user()->unreadNotifications()->get();
                $out = [];
                foreach ($unread_notif as $notif){
                    $notif_type = $notif['type'];
                    $notif_id = $notif['id'];
                    $user_id = $notif['data']['user_id'];
                    $user_name = $notif['data']['user_name'];
                    $video_id = '';

                    if(array_key_exists('video_id', $notif['data'])){
                        $video_id = $notif['data']['video_id'];
                    }

                    array_push($out, [
                        'notif_id' => $notif_id,
                        'user_id' => $user_id,
                        'user_name' => $user_name,
                        'video_id' => $video_id,
                        'notif_type' => $notif_type,
                    ]);

                }
                $view->with('notifications', $out);
            }
        });
    }
}
