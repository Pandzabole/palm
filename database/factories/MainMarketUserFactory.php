<?php

namespace Database\Factories;

use App\Models\MainMarketUser;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;

class MainMarketUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MainMarketUser::class;

    /**
     * Define the model's default state.
     *
     * @return array
     * @throws Exception
     */
    public function definition(): array
    {
        return [
            'main_market_id' => random_int(1, 2),
            'user_id' =>  random_int(1, 2),
        ];
    }
}
