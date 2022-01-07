<?php

namespace Database\Seeders;

use App\Models\About;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        About::create([
            'description_indo' => 'lorem',
            'description_english' => 'lorem',
            'video_url' => 'lorem',
            'vision' => 'lorem',
            'mission' => 'lorem',
            'image' => ''
        ]);
    }
}
