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
     */
    public function definition(): array
    {
        return [
            'uuid' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
            'name' => 'Class ' . self::$position++,
            'description' => 'Description' . self::$position++,
            'description_first' => 'Description first' . self::$position++,
            'description_second' => 'Description second' . self::$position++,
            'price_usd' => 500,
            'price_eur' => 350,
            'price_sar' => 1700,
            'price_omr' => 1900,
            'position' => self::$position++,
            'class_length' => 50,
            'age_restriction' => 18,
            'class_category_id' => 1,
            'class_sub_category_id' => 1,
            'teacher_id' => 1,
            'class_level_id' => 1,
        ];
    }
}
