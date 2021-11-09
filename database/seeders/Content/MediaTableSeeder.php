<?php

namespace Database\Seeders\Content;

use App\Models\Media;
use Illuminate\Database\Seeder;

class MediaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Media::factory()->desktop(false)->create();
        Media::factory()->mobile(false)->create();
        Media::factory()->desktop(false)->create();
        Media::factory()->mobile(false)->create();
        Media::factory()->video(false)->create();
    }
}
