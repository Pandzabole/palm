<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $languages = [
            [
                'name' => 'English',
                'native_name' => 'english',
                'short' => 'en',
                'connection_name' => 'database-en',
                'created_at' => now(),
                'default' => true,
            ],
            [
                'name' => 'Arabic',
                'native_name' => 'arabic',
                'short' => 'ar',
                'connection_name' => 'database-ar',
                'created_at' => now(),
                'default' => false,
            ]
        ];

        Language::insert($languages);
    }
}
