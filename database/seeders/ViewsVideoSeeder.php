<?php

namespace Database\Seeders;

use App\Models\VideoView;
use Illuminate\Database\Seeder;

class ViewsVideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $views = VideoView::factory(1000)->create();
    }
}
