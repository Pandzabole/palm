<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Page;
use Illuminate\Support\Str;

class PageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Page::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $name = $this->faker->unique()->sentence;
        static $position = 1;

        return [
            'name' => $this->faker->name,
            'slug' => Str::slug($name),
            'href' => '/' . Str::slug($name),
            'position' => $position++,
            'cta_type' => 'internal'
        ];
    }
}
