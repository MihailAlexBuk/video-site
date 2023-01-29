<?php

namespace Database\Seeders;

use App\Models\TagVideo;
use Illuminate\Database\Seeder;

class TagVideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tagVideo = TagVideo::factory()->count(200)->create();
    }
}
