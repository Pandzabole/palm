<?php

namespace Database\Factories\Content;

use App\Models\Content\ImageContent;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImageContentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ImageContent::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->text(10),
            'alt' => $this->faker->sentence
        ];
    }
}
