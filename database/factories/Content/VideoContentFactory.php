<?php

namespace Database\Factories\Content;

use App\Models\Content\VideoContent;
use Illuminate\Database\Eloquent\Factories\Factory;

class VideoContentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = VideoContent::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->text(10),
        ];
    }
}
