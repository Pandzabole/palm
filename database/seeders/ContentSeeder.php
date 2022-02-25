<?php

namespace Database\Seeders;

use Database\Seeders\Content\ActivitiesSeeder;
use Database\Seeders\Content\ActivityCategorySeeder;
use Database\Seeders\Content\MediaTableSeeder;
use Database\Seeders\Content\MiscInformationTableSeeder;
use Database\Seeders\Content\NewsCategorySeeder;
use Database\Seeders\Content\NewsSeeder;
use Database\Seeders\Content\PagesTableSeeder;
use Database\Seeders\Content\MarketsTableSeeder;
use Database\Seeders\Content\PublishSeeder;
use Database\Seeders\Content\ClassLevelSeeder;
use Database\Seeders\Content\StaticComponentsContactSeeder;
use Database\Seeders\Content\StaticComponentsHomeSeeder;
use Database\Seeders\Content\StaticComponentsOurWaterSeeder;
use Database\Seeders\Content\SliderSeeder;
use Database\Seeders\Content\MetaDataSeeder;
use Database\Seeders\Content\GenderSeeder;
use Database\Seeders\Content\MainCategorySeeder;
use Database\Seeders\Content\ClassSubCategorySeeder;
use Database\Seeders\Content\ClassLocationSeeder;
use Database\Seeders\Content\TeacherSeeder;
use Database\Seeders\Content\ClassMainSubCategory;
use Database\Seeders\Content\ClasseSeeder;
use Illuminate\Database\Seeder;

class ContentSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call(MediaTableSeeder::class);
        $this->call(PagesTableSeeder::class);
        $this->call(MarketsTableSeeder::class);
        $this->call(StaticComponentsContactSeeder::class);
        $this->call(StaticComponentsHomeSeeder::class);
        $this->call(StaticComponentsOurWaterSeeder::class);
        $this->call(ActivityCategorySeeder::class);
        $this->call(ActivitiesSeeder::class);
        $this->call(NewsCategorySeeder::class);
        $this->call(NewsSeeder::class);
        $this->call(SliderSeeder::class);
        $this->call(MiscInformationTableSeeder::class);
        $this->call(PublishSeeder::class);
        $this->call(MetaDataSeeder::class);
        $this->call(GenderSeeder::class);
        $this->call(ClassLocationSeeder::class);
        $this->call(MainCategorySeeder::class);
        $this->call(ClassSubCategorySeeder::class);
        $this->call(TeacherSeeder::class);
        $this->call(ClassMainSubCategory::class);
        $this->call(ClassLevelSeeder::class);
        $this->call(ClasseSeeder::class);

    }
}
