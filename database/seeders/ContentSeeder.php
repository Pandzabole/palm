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
use Database\Seeders\Content\StaticComponentsContactSeeder;
use Database\Seeders\Content\StaticComponentsHomeSeeder;
use Database\Seeders\Content\StaticComponentsOurWaterSeeder;
use Database\Seeders\Content\ProductsSeeder;
use Database\Seeders\Content\StaticComponentsProductSeeder;
use Database\Seeders\Content\SliderSeeder;
use Database\Seeders\Content\PackageVolumeTableSeeder;
use Database\Seeders\Content\PackageNumberTableSeeder;
use Database\Seeders\Content\MetaDataSeeder;
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
        $this->call(PackageVolumeTableSeeder::class);
        $this->call(PackageNumberTableSeeder::class);
        $this->call(ProductsSeeder::class);
        $this->call(StaticComponentsContactSeeder::class);
        $this->call(StaticComponentsHomeSeeder::class);
        $this->call(StaticComponentsProductSeeder::class);
        $this->call(StaticComponentsOurWaterSeeder::class);
        $this->call(ActivityCategorySeeder::class);
        $this->call(ActivitiesSeeder::class);
        $this->call(NewsCategorySeeder::class);
        $this->call(NewsSeeder::class);
        $this->call(SliderSeeder::class);
        $this->call(MiscInformationTableSeeder::class);
        $this->call(PublishSeeder::class);
        $this->call(MetaDataSeeder::class);
    }
}
