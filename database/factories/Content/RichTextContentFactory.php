<?php

namespace Database\Factories\Content;

use App\Models\Content\RichTextContent;
use Illuminate\Database\Eloquent\Factories\Factory;

class RichTextContentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RichTextContent::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->text(10),
            'content' => "<div>
                <h1>{$this->faker->text(5)}</h1>
                <p>{$this->faker->text(10)}</p>
                <h2>{$this->faker->text(5)}</h2>
                <p>{$this->faker->text(50)}</p>
                <h3>{$this->faker->text(5)}</h3>
                <p>{$this->faker->text(50)}</p>
            </div>"
        ];
    }
}
