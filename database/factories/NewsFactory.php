<?php

namespace Database\Factories;

use App\Models\News;
use App\Traits\FactoryPosition;
use Illuminate\Database\Eloquent\Factories\Factory;

class NewsFactory extends Factory
{
    use FactoryPosition;

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = News::class;

    /** @var int $highlighted */
    public static $highlighted = true;

    /**
     * Reset position to default value
     */
    public static function resetHighlighted(): void
    {
        self::$highlighted = true;
    }

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $attributes = [
            'title' => $this->faker->sentence(2),
            'description' => $this->faker->sentence(20),
            'news_component_id' => 1,
            'highlighted' => self::$highlighted,
            'position' => self::$position++,
        ];

        self::$highlighted = false;

        return $attributes;
    }
}
