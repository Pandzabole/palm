<?php

namespace Database\Seeders;

use App\Models\MainMarketUser;
use Illuminate\Database\Seeder;

class MainMarketUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $marketUser = [
            [
                'main_market_id' => 1,
                'user_id' => 2
            ],
            [
                'main_market_id' => 2,
                'user_id' => 3
            ],
            [
                'main_market_id' => 2,
                'user_id' => 1
            ],
            [
                'main_market_id' => 1,
                'user_id' => 1
            ]

        ];

        MainMarketUser::insert($marketUser);
    }
}
