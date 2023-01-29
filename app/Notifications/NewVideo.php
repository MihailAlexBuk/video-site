<?php

namespace App\Notifications;

use App\Models\User;
use App\Models\Video;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewVideo extends Notification
{
    use Queueable;

    protected $video, $following;

    public function __construct(User $following, $video)
    {
        $this->video = $video;
        $this->following = $following;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'user_name' => $this->following->name,
            'user_id' => $this->following->id,
            'video_id' => $this->video->id,
        ];
    }
}
