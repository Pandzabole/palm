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
                'name' => 'Arts & Entertainment',
            ],
            [
                'name' => 'Cooking & Tasting',
            ],
            [
                'name' => 'Sports & Wellness',
            ],
            [
                'name' => 'Kids & Family',
            ],
            [
                'name' => 'Life Skills',
            ],
            [
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
                'name' => 'فنون وترفيه',
            ],
            [
                'name' => 'الطبخ والتذوق',
            ],
            [
                'name' => 'الرياضة والعافية',
            ],
            [
                'name' => 'الأطفال والعائلة',
            ],
            [
                'name' => 'المهارات الحياتية',
            ],
            [
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
                'name' => 'فنون وترفيه',
            ],
            [
                'name' => 'الطبخ والتذوق',
            ],
            [
                'name' => 'الرياضة والعافية',
            ],
            [
                'name' => 'الأطفال والعائلة',
            ],
            [
                'name' => 'المهارات الحياتية',
            ],
            [
                'name' => 'العمل الوظيفي',
            ]
        ];
    }
}
