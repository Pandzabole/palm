<?php

namespace Database\Factories;

use App\Models\Activity;
use App\Traits\FactoryPosition;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActivityFactory extends Factory
{
    use FactoryPosition;

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Activity::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(2),
            'description' => $this->faker->sentence(20),
            'activity_component_id' => 1,
            'position' => self::$position++,
        ];
    }
}
