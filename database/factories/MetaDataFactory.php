<?php

namespace Database\Factories;

use App\Models\MetaData;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Traits\FactoryPosition;

class MetaDataFactory extends Factory
{

    use FactoryPosition;

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MetaData::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(2),
            'keywords' => 'keyword,keyword2,keyword3',
            'description' => $this->faker->sentence(10),
            'page_id' => self::$position++,
        ];
    }
}
