<?php

namespace Database\Factories\Content;

use App\Models\Content\Content;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Content::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        static $position = 1;

        return [
            //'sort_order' => $position++
        ];
    }
}
