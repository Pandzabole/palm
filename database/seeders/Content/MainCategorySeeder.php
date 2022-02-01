<?php

namespace Database\Seeders\Content;

use App\Models\ClassCategory;
use App\Traits\SeedContainable;
use Illuminate\Database\Seeder;

class MainCategorySeeder extends Seeder
{
    use SeedContainable;

    /** @var string $modelClass */
    private $modelClass = ClassCategory::class;

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
                'name' => 'Arts & Entertainment',
            ],
            [
                'uuid' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
                'name' => 'Cooking & Tasting',
            ],
            [
                'uuid' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
                'name' => 'Sports & Wellness',
            ],
            [
                'uuid' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
                'name' => 'Kids & Family',
            ],
            [
                'uuid' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
                'name' => 'Life Skills',
            ],
            [
                'uuid' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
                'name' => 'Business & career',
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
                'uuid' => 'das616-asdsa-664646',
                'name' => 'فنون وترفيه',
            ],
            [
                'uuid' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
                'name' => 'الطبخ والتذوق',
            ],
            [
                'uuid' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
                'name' => 'الرياضة والعافية',
            ],
            [
                'uuid' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
                'name' => 'الأطفال والعائلة',
            ],
            [
                'uuid' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
                'name' => 'المهارات الحياتية',
            ],
            [
                'uuid' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
                'name' => 'العمل الوظيفي',
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
                'uuid' => 'das616-asdsa-664646',
                'name' => 'فنون وترفيه',
            ],
            [
                'uuid' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
                'name' => 'الطبخ والتذوق',
            ],
            [
                'uuid' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
                'name' => 'الرياضة والعافية',
            ],
            [
                'uuid' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
                'name' => 'الأطفال والعائلة',
            ],
            [
                'uuid' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
                'name' => 'المهارات الحياتية',
            ],
            [
                'uuid' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
                'name' => 'العمل الوظيفي',
            ]
        ];
    }
}
