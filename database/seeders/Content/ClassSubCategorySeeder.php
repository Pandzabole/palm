<?php

namespace Database\Seeders\Content;

use App\Models\ClassSubCategory;
use App\Traits\SeedContainable;
use Illuminate\Database\Seeder;

class ClassSubCategorySeeder extends Seeder
{
    use SeedContainable;

    /** @var string $modelClass */
    private $modelClass = ClassSubCategory::class;

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
                'uuid' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
                'name' => 'Painting',
            ],
            [
                'uuid' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
                'name' => 'Cakes',
            ],
            [
                'uuid' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
                'name' => 'Football',
            ],
            [
                'uuid' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
                'name' => 'Learning',
            ],
            [
                'uuid' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
                'name' => 'Teaching',
            ],
            [
                'uuid' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
                'name' => 'Accounting',
            ]
        ];
    }

    /**
     * @return array
     */
    protected function getArData(): array
    {
        return [
            [
                'uuid' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
                'name' => 'تلوين',
            ],
            [
                'uuid' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
                'name' => 'كيك',
            ],
            [
                'uuid' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
                'name' => 'كرة القدم',
            ],
            [
                'uuid' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
                'name' => 'التعلم',
            ],
            [
                'uuid' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
                'name' => 'تعليم',
            ],
            [
                'uuid' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
                'name' => 'محاسبة',
            ]
        ];
    }

    /**
     * @return array
     */
    protected function getOmData(): array
    {
        return [
            [
                'uuid' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
                'name' => 'تلوين',
            ],
            [
                'uuid' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
                'name' => 'كيك',
            ],
            [
                'uuid' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
                'name' => 'كرة القدم',
            ],
            [
                'uuid' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
                'name' => 'التعلم',
            ],
            [
                'uuid' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
                'name' => 'تعليم',
            ],
            [
                'uuid' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
                'name' => 'محاسبة',
            ]
        ];
    }
}
