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
            'position' => self::$position++,
            'main_text' => 'New classes',
            'second_text' => 'New classes',
        ];
    }
}
