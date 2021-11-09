<?php

namespace Database\Factories;

use App\Traits\FactoryPosition;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Market;
use Illuminate\Support\Str;

class MarketFactory extends Factory
{
    use FactoryPosition;

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Market::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $name = $this->faker->unique()->sentence;
        static $position = 1;

        return [
            'name' => $this->faker->name,
            'href' => '/' . Str::slug($name),
            'position' =>  self::$position++,
            'cta_type' => 'internal'
        ];
    }
}
