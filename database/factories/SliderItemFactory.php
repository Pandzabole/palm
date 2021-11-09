<?php

namespace Database\Factories;

use App\Models\SliderItem;
use App\Traits\FactoryPosition;
use Illuminate\Database\Eloquent\Factories\Factory;

class SliderItemFactory extends Factory
{
    use FactoryPosition;

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SliderItem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'cta_type' => 'internal',
            'position' => self::$position++,
            'url' => $this->faker->url,
            'cta' => $this->faker->word,
            'description' => $this->faker->text,
        ];
    }
}
