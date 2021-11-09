<?php

namespace Database\Factories\Content;

use App\Models\Content\TextContent;
use Illuminate\Database\Eloquent\Factories\Factory;

class TextContentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TextContent::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->text(10),
            'type' => $this->faker->randomElement(config('content.text_types')),
            'content' => $this->faker->sentence
        ];
    }
}
