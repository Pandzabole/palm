<?php

namespace Database\Seeders\Content;

use App\Models\ClassCategoryClassSubCategory;
use App\Traits\SeedContainable;
use Illuminate\Database\Seeder;

class ClassMainSubCategory extends Seeder
{
    use SeedContainable;

    /** @var string $modelClass */
    private $modelClass = ClassCategoryClassSubCategory::class;

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
                'class_category_id' => 1,
                'class_sub_category_id' => 1,
            ],
            [
                'class_category_id' => 1,
                'class_sub_category_id' => 2,
            ],
            [
                'class_category_id' => 2,
                'class_sub_category_id' => 3,
            ],
            [
                'class_category_id' => 1,
                'class_sub_category_id' => 4,
            ],
            [
                'class_category_id' => 3,
                'class_sub_category_id' => 2,
            ],
            [
                'class_category_id' => 1,
                'class_sub_category_id' => 5,
            ]
        ];
    }

    /**
     * @return array
     */
    protected function getArData(): array
    {
       return $this->getEnData();
    }

    /**
     * @return array
     */
    protected function getOmData(): array
    {
        return $this->getEnData();
    }
}
