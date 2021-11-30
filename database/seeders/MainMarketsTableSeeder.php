<?php

namespace Database\Seeders;

use App\Models\MainMarket;
use App\Models\User;
use Illuminate\Database\Seeder;

class MainMarketsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $markets = [
            [
                'name' => 'English',
                'href' => '/en',
                'short' => 'en',
                'position' => 1,
                'privileges' => User::MICRO_ADMIN,
                'created_at' => now(),
            ],
            [
                'name' => 'Arabic',
                'href' => '/ar',
                'short' => 'ar',
                'position' => 2,
                'privileges' => User::MICRO_ADMIN,
                'created_at' => now(),
            ],
            [
                'name' => 'Oman',
                'href' => '/om',
                'short' => 'om',
                'position' => 3,
                'privileges' => User::MICRO_ADMIN,
                'created_at' => now(),
            ]
        ];

        MainMarket::insert($markets);
    }
}
