<?php

namespace Database\Seeders\Content;

use App\Models\ActivityCategory;
use App\Traits\SeedContainable;
use Illuminate\Database\Seeder;

class ActivityCategorySeeder extends Seeder
{
    use SeedContainable;

    /** @var string $modelClass */
    private $modelClass = ActivityCategory::class;

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
                'name' => 'Category 1',
                'slug' => 'category_1'
            ],
            [
                'name' => 'Category 2',
                'slug' => 'category_2'
            ],
            [
                'name' => 'Category 3',
                'slug' => 'category_3'
            ],
            [
                'name' => "Category 4",
                'slug' => 'category_4'
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
                'name' => 'الفئة 1',
                'slug' => 'category_1'
            ],
            [
                'name' => ' الفئة 1',
                'slug' => 'category_2'
            ],
            [
                'name' => 'الفئة 3',
                'slug' => 'category_3'
            ],
            [
                'name' => "الفئة 4",
                'slug' => 'category_4'
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
                'name' => 'الفئة 1',
                'slug' => 'category_1'
            ],
            [
                'name' => ' الفئة 1',
                'slug' => 'category_2'
            ],
            [
                'name' => 'الفئة 3',
                'slug' => 'category_3'
            ],
            [
                'name' => "الفئة 4",
                'slug' => 'category_4'
            ]
        ];
    }
}
