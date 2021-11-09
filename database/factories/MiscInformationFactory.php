<?php

namespace Database\Factories;

use App\Models\MiscInformation;
use Illuminate\Database\Eloquent\Factories\Factory;

class MiscInformationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MiscInformation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'type' => $this->faker->randomElement(MiscInformation::TYPES),
            'value' => $this->faker->word
        ];
    }

    /**
     * Indicate that the information is received type
     *
     * @param string $type
     * @return Factory
     */
    public function type(string $type): Factory
    {
        return $this->state(
            function (array $attributes) use ($type) {
                return [
                    'type' => $type,
                ];
            }
        );
    }
}
