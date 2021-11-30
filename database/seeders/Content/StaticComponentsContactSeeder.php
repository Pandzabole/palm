<?php

namespace Database\Seeders\Content;

use App\Traits\SeedContainable;
use Illuminate\Database\Seeder;

class StaticComponentsContactSeeder extends Seeder
{
    use SeedContainable;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $currentSchema = $this->getCurrentSchema();

        $this->seedStaticData($currentSchema, 7);
    }

    /**
     * @return array
     */
    protected function getEnData(): array
    {
        return [
            [
                'tag' => null,
                'primary_title' => 'Contact us',
                'secondary_title' => 'because we are always here for you',
                'sub_title' => null,
                'description' => null,
                'cta' => null,
                'url' => null,
                'cta_type' => 'internal',
                'slug' => null,
                'type' => 'staticComponent',
                'position' => 1,
                'created_at' => now(),
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
                'tag' => null,
                'primary_title' => 'اتصل بنا',
                'secondary_title' => 'لأننا دائما هناك من أجلك',
                'sub_title' => null,
                'description' => null,
                'cta' => null,
                'url' => null,
                'cta_type' => "internal",
                'slug' => null,
                'type' => 'staticComponent',
                'position' => 1,
                'created_at' => now(),
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
                'tag' => null,
                'primary_title' => 'اتصل بنا',
                'secondary_title' => 'لأننا دائما هناك من أجلك',
                'sub_title' => null,
                'description' => null,
                'cta' => null,
                'url' => null,
                'cta_type' => "internal",
                'slug' => null,
                'type' => 'staticComponent',
                'position' => 1,
                'created_at' => now(),
            ]
        ];
    }
}
