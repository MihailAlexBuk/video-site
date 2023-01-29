<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Video;
use App\Models\VideoView;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class VideoViewFactory extends Factory
{

    protected $model = VideoView::class;

    public function definition()
    {
        $video = Video::query()->inRandomOrder()->value('id');
        return [
            'video_id' => $video,
            'url' => 'http://127.0.0.1:8000/watch/'.$video,
            'session_id' => Str::random(40),
            'user_id' => User::query()->inRandomOrder()->value('id'),
            'ip' => '127.0.0.1',
            'agent' => 'Mozilla/5.0 (X11; Linux x86_64; rv:102.0) Gecko/20100101 Firefox/102.0',
        ];
    }
}
