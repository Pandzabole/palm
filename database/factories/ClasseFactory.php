<?php

namespace Database\Factories;

use App\Models\Classe;
use App\Traits\FactoryPosition;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClasseFactory extends Factory
{
    use FactoryPosition;

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Classe::class;

    /**
     * Define the model's default state.
     *
     * @return array
     * @throws \Exception
     */
    public function definition(): array
    {
        return [
            'uuid' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
            'name' => $this->faker->sentence(4),
            'description' => $this->faker->sentence(50),
            'description_first' => $this->faker->sentence(50),
            'description_second' => $this->faker->sentence(50),
            'price_usd' => 500,
            'price_eur' => 350,
            'price_sar' => 1700,
            'price_omr' => 1900,
            'position' => self::$position++,
            'class_length' => 50,
            'age_restriction' => random_int(12, 18),
            'class_category_id' => random_int(1, 6),
            'class_sub_category_id' => random_int(1, 6),
            'teacher_id' => random_int(1, 3),
            'class_level_id' => random_int(1, 3),
        ];
    }
}
