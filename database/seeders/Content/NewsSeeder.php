<?php

namespace Database\Seeders\Content;

use App\Models\Content\ImageContent;
use App\Models\Content\RichTextContent;
use App\Models\Content\TextContent;
use App\Models\Content\VideoContent;
use App\Models\News;
use App\Traits\SeedContainable;
use Database\Factories\NewsFactory;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
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
    public function getEnData(): void
    {
        NewsFactory::resetPosition();
        NewsFactory::resetHighlighted();

        News::factory()
            ->count(4)
            ->create(['news_component_id' => 5])
            ->each(
                function ($news) {
                    $news->categories()->attach(array_rand([1, 2, 3, 4], 3));
                    $this->seedContent($news->id);
                    $news->media()->attach(1);
                }
            );
    }

    /**
     * @return void
     */
    public function getArData(): void
    {
        $this->getEnData();
    }

    /**
     * @return void
     */
    public function getOmData(): void
    {
        $this->getEnData();
    }

    /**
     * @param int $newsId
     */
    private function seedContent(int $newsId): void
    {
        TextContent::factory()
            ->hasContains(
                [
                    'containable_type' => News::class,
                    'containable_id' => $newsId,
                    'sort_order' => 1
                ]
            )
            ->create();

        RichTextContent::factory()
            ->hasContains(
                [
                    'containable_type' => News::class,
                    'containable_id' => $newsId,
                    'sort_order' => 2
                ]
            )
            ->create();

        ImageContent::factory()
            ->hasContains(
                [
                    'containable_type' => News::class,
                    'containable_id' => $newsId,
                    'sort_order' => 3
                ]
            )
            ->create()
            ->media()
            ->attach(1);

        VideoContent::factory()
            ->hasContains(
                [
                    'containable_type' => News::class,
                    'containable_id' => $newsId,
                    'sort_order' => 4
                ]
            )
            ->create()
            ->media()
            ->attach(5);
    }
}
