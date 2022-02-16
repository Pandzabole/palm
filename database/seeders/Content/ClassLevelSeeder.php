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
                'uuid' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
            ],
            [
                'level' => 'Intermediate',
                'uuid' => \Ramsey\Uuid\Uuid::uuid4()->toString(),

            ],
            [
                'level' => 'Advanced',
                'uuid' => \Ramsey\Uuid\Uuid::uuid4()->toString(),

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
                'uuid' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
            ],
            [
                'level' => 'متوسط',
                'uuid' => \Ramsey\Uuid\Uuid::uuid4()->toString(),

            ],
            [
                'level' => 'متقدم',
                'uuid' => \Ramsey\Uuid\Uuid::uuid4()->toString(),

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
                'uuid' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
            ],
            [
                'level' => 'متوسط',
                'uuid' => \Ramsey\Uuid\Uuid::uuid4()->toString(),

            ],
            [
                'level' => 'متقدم',
                'uuid' => \Ramsey\Uuid\Uuid::uuid4()->toString(),

            ],
        ];
    }
}
