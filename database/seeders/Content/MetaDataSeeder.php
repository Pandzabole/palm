<?php

namespace Database\Seeders\Content;

use App\Models\Activity;
use App\Traits\SeedContainable;
use Database\Factories\MetaDataFactory;
use Illuminate\Database\Seeder;
use App\Models\MetaData;

class MetaDataSeeder extends Seeder
{
    use SeedContainable;

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
     * @return void
     */
    protected function getEnData(): void
    {
        MetaDataFactory::resetPosition();
        MetaData::factory()
            ->count(7)
            ->create()
            ->each(
                function ($metaData) {
                    $metaData->media()->attach(1);
                }
            );
    }

    /**
     * @return void
     */
    protected function getArData(): void
    {
        MetaDataFactory::resetPosition();
        MetaData::factory()
            ->count(7)
            ->create()
            ->each(
                function ($metaData) {
                    $metaData->media()->attach(1);
                }
            );
    }

    /**
     * @return void
     */
    protected function getOmData(): void
    {
        MetaDataFactory::resetPosition();
        MetaData::factory()
            ->count(7)
            ->create()
            ->each(
                function ($metaData) {
                    $metaData->media()->attach(1);
                }
            );
    }
}
