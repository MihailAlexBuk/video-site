<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'avatar' => 'images/x7iiJcYOAqIjLMENnkiSfAHEgI9PCn4SigiQDl4v.svg',
            'password' => '$2y$10$8zEOxDhoolu5R32V.YQcyelLL3T9aE.DUee4Yks2MvDF8SLiDVVf.', // 12345
            'remember_token' => Str::random(10),
            'role' => '0'
        ]);
    }
}
