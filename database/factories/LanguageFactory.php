<?php

namespace Database\Factories;

use App\Models\Language;
use Illuminate\Database\Eloquent\Factories\Factory;

class LanguageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Language::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $short = $this->faker->unique()->languageCode;
        $counter = 1;

        return [
            'name' => $this->faker->text(10),
            'native_name' => $this->faker->text(12),
            'short' => $short,
            'published' => 1,
            'connection_name' => "testing_$short",
            'default' => $counter === 1
        ];
    }
}
