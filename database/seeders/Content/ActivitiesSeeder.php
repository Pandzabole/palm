<?php

namespace Database\Seeders\Content;

use App\Models\Activity;
use App\Models\ActivityCategory;
use App\Models\Content\ImageContent;
use App\Models\Content\RichTextContent;
use App\Models\Content\TextContent;
use App\Models\Content\VideoContent;
use App\Traits\SeedContainable;
use Database\Factories\ActivityFactory;
use Illuminate\Database\Seeder;

class ActivitiesSeeder extends Seeder
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
        ActivityFactory::resetPosition();
        Activity::factory()
            ->count(4)
            ->create(['activity_component_id' => 6])
            ->each(
                function ($activity) {
                    $activity->categories()->attach(array_rand([1, 2, 3, 4], 3));
                    $this->seedContent($activity->id);
                    $activity->media()->attach(1);
                }
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

    /**
     * @param int $activityId
     */
    private function seedContent(int $activityId): void
    {
        TextContent::factory()
            ->hasContains(
                [
                    'containable_type' => Activity::class,
                    'containable_id' => $activityId,
                    'sort_order' => 1
                ]
            )
            ->create();

        RichTextContent::factory()
            ->hasContains(
                [
                    'containable_type' => Activity::class,
                    'containable_id' => $activityId,
                    'sort_order' => 2
                ]
            )
            ->create();

        ImageContent::factory()
            ->hasContains(
                [
                    'containable_type' => Activity::class,
                    'containable_id' => $activityId,
                    'sort_order' => 3
                ]
            )
            ->create()
            ->media()
            ->attach(1);

        VideoContent::factory()
            ->hasContains(
                [
                    'containable_type' => Activity::class,
                    'containable_id' => $activityId,
                    'sort_order' => 4
                ]
            )
            ->create()
            ->media()
            ->attach(5);
    }
}
