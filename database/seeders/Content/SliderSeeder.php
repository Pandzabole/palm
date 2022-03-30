<?php

namespace Database\Seeders\Content;

use App\Models\Slider;
use App\Models\SliderItem;
use App\Traits\SeedContainable;
use Database\Factories\SliderItemFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SliderSeeder extends Seeder
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
        $slider = Slider::factory()->create();

        SliderItemFactory::resetPosition();
        SliderItem::factory()
            ->count(2)
            ->create(['slider_id' => $slider->id])
            ->each(
                function ($sliderItem) {
                    $sliderItem->media()->attach([1, 2]);
                }
            );

        DB::table('components')->insertOrIgnore(
            [
                'page_id' => 1,
                'component_type' => Slider::class,
                'component_id' => $slider->id
            ]
        );
    }

    /**
     * @return void
     */
    protected function getArData(): void
    {
        $this->getEnData();
    }

    /**
     * @return void
     */
    protected function getOmData(): void
    {
        $this->getEnData();
    }
}
