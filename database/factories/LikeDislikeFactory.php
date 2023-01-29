<?php

namespace Database\Factories;

use App\Models\LikeDislike;
use App\Models\User;
use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\Factory;

class LikeDislikeFactory extends Factory
{

    protected $model = LikeDislike::class;

    public function definition()
    {
        (($like = rand(0,1)) === 1) ? $dislike = 0 : $dislike = 1;

        return [
            'video_id' => Video::query()->inRandomOrder()->value('id'),
            'user_id' => User::query()->inRandomOrder()->value('id'),
            'like' => $like,
            'dislike' => $dislike,
            'created_at' => $this->faker->date('2023-m-d')
        ];
    }
}
