<?php

namespace Database\Factories;

use App\Models\Tag;
use App\Models\TagVideo;
use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\Factory;

class TagVideoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = TagVideo::class;

    public function definition()
    {
        return [
            'video_id' => Video::query()->inRandomOrder()->value('id'),
            'tag_id' => Tag::query()->inRandomOrder()->value('id'),
        ];
    }
}
