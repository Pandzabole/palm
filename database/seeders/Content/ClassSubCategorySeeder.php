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
                'name' => 'Painting',
            ],
            [
                'name' => 'Cakes',
            ],
            [
                'name' => 'Football',
            ],
            [
                'name' => 'Learning',
            ],
            [
                'name' => 'Teaching',
            ],
            [
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
                'name' => 'تلوين',
            ],
            [
                'name' => 'كيك',
            ],
            [
                'name' => 'كرة القدم',
            ],
            [
                'name' => 'التعلم',
            ],
            [
                'name' => 'تعليم',
            ],
            [
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
                'name' => 'تلوين',
            ],
            [
                'name' => 'كيك',
            ],
            [
                'name' => 'كرة القدم',
            ],
            [
                'name' => 'التعلم',
            ],
            [
                'name' => 'تعليم',
            ],
            [
                'name' => 'محاسبة',
            ]
        ];
    }
}
