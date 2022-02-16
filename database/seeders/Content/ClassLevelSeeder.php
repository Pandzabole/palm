<?php

namespace Database\Seeders\Content;

use App\Models\ClassLevel;
use App\Traits\SeedContainable;
use Illuminate\Database\Seeder;

class ClassLevelSeeder extends Seeder
{
    use SeedContainable;

    /** @var string $modelClass */
    private $modelClass = ClassLevel::class;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $this->seedData();
    }

    /**
     * @return array
     */
    protected function getEnData(): array
    {
        return [
            [
                'level' => 'Beginner',
            ],
            [
                'level' => 'Intermediate',

            ],
            [
                'level' => 'Advanced',

            ],
        ];
    }

    /**
     * @return array
     */
    protected function getArData(): array
    {
        return [
            [
                'level' => 'مبتدئ',
            ],
            [
                'level' => 'متوسط',

            ],
            [
                'level' => 'متقدم',

            ],
        ];
    }

    /**
     * @return array
     */
    protected function getOmData(): array
    {
        return [
            [
                'level' => 'مبتدئ',
            ],
            [
                'level' => 'متوسط',

            ],
            [
                'level' => 'متقدم',
            ],
        ];
    }
}
