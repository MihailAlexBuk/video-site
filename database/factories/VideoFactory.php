<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\Factory;

class VideoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = Video::class;

    public function definition()
    {
        return [
            'title' => ucfirst($this->faker->word()),
            'desc' => $this->faker->text(400),
            'video_url' => 'video/oBCWKVUEtqHZiBnw01DInoxLTN3NxJj07qgvfMcf.mp4',
            'poster' => 'images/4IULV18tNO1L3dbh1mtp7OWLTLYvdF6xn1zcejrA.jpg',
//            'poster' => $this->faker->imageUrl(196, 130),
            'category_id' => Category::query()->inRandomOrder()->value('id'),
            'user_id' => User::query()->inRandomOrder()->value('id'),
            ];
    }
}
