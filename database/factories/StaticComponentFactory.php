<?php

namespace Database\Factories;

use App\Models\StaticComponent;
use App\Traits\FactoryPosition;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class StaticComponentFactory extends Factory
{
    use FactoryPosition;

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = StaticComponent::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'tag' => $this->faker->word,
            'primary_title' => $this->faker->word,
            'secondary_title' => $this->faker->word,
            'sub_title' => $this->faker->word,
            'slug' => Str::slug($this->faker->word),
            'cta_type' => 'internal',
            'position' => self::$position++,
            'url' => $this->faker->url,
            'cta' => $this->faker->word,
            'description' => $this->faker->text,
            'type' => 'staticComponent',
        ];
    }

    /**
     * Indicate that  is received type
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
