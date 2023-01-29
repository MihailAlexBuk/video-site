<?php

namespace Database\Seeders;

use App\Models\LikeDislike;
use Illuminate\Database\Seeder;

class LikeDislikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $like_dislike = LikeDislike::factory()->count(100)->create();
    }
}
