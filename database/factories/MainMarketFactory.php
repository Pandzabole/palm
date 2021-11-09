<?php

namespace Database\Factories;

use App\Traits\FactoryPosition;
use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\MainMarket;
use Illuminate\Support\Str;

class MainMarketFactory extends Factory
{
    use FactoryPosition;

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MainMarket::class;

    /**
     * Define the model's default state.
     *
     * @return array
     * @throws Exception
     */
    public function definition(): array
    {
        $name = $this->faker->unique()->sentence;

        return [
            'name' => $this->faker->name,
            'href' => '/' . Str::slug($name),
            'short' => 'sr',
            'position' => self::$position++,
            'cta_type' => 'internal',
            'privileges' => 3
        ];
    }
}

