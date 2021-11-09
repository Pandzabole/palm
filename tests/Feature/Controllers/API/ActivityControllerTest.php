<?php

namespace Feature\Controllers\API;

use App\Models\Activity;
use App\Models\ActivityCategory;
use App\Models\Content\ImageContent;
use App\Models\Content\RichTextContent;
use App\Models\Content\TextContent;
use App\Models\Content\VideoContent;
use App\Models\Media;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Tests\ContentTestCase;

class ActivityControllerTest extends ContentTestCase
{
    /** @var Collection $activities */
    private $activities;

    /** @var Collection $contents */
    private $contents;

    /** @var Collection $categories */
    private $categories;

    /** @var bool $seedContents */
    private $seedContents = false;

    /**
     * @test
     * @return void
     */
    public function it_returns_activities(): void
    {
        // arrange
        $dataToAssert = $this->prepareActivitiesToAssert(5);

        // act
        $response = $this->getApiJsonResponse('activities');

        // assert
        self::assertEquals($dataToAssert, $response->getData(true));
        $response->assertSuccessful();
    }

    /**
     * @test
     * @return void
     */
    public function it_returns_activities_paginated(): void
    {
        // arrange
        $dataStructure = ['activity_items', 'links', 'meta'];
        $dataToAssert = $this->prepareActivitiesToAssert(5);

        // act
        $response = $this->getApiJsonResponse('activities/paginate');

        // assert
        $response->assertJsonStructure($dataStructure);
        self::assertEquals($dataToAssert, $response->getData(true)['activity_items']);
        $response->assertSuccessful();
    }

    /**
     * @test
     * @return void
     */
    public function it_returns_activities_by_category_slug(): void
    {
        // arrange
        $this->setActivities(5);
        $category = $this->categories->first();
        $activities = $this->prepareActivityToAssertByCategory($category);
        $dataToAssert = $this->prepareActivitiesToAssert(5, $activities);

        // act
        $response = $this->getApiJsonResponse('activities', ['category' => $category->slug]);

        // assert
        self::assertEquals($dataToAssert, $response->getData(true));
        $response->assertSuccessful();
    }

    /**
     * @test
     * @return void
     */
    public function it_returns_activities_paginated_by_category_slug(): void
    {
        // arrange
        $this->setActivities(5);
        $category = $this->categories->first();
        $dataStructure = ['activity_items', 'links', 'meta'];
        $activities = $this->prepareActivityToAssertByCategory($category);
        $dataToAssert = $this->prepareActivitiesToAssert(5, $activities);

        // act
        $response = $this->getApiJsonResponse('activities/paginate', ['category' => $category->slug]);

        // assert
        $response->assertJsonStructure($dataStructure);
        self::assertEquals($dataToAssert, $response->getData(true)['activity_items']);
        $response->assertSuccessful();
    }

    /**
     * @test
     * @return void
     */
    public function it_returns_single_activity_by_slug(): void
    {
        // arrange
        $this->seedContents = true;
        $dataToAssert = $this->prepareActivitiesToAssert()[0];
        $activity = $this->activities->first();

        // act
        $response = $this->getApiJsonResponse('activities/' . $activity['slug']);

        // assert
        $response->assertJson($dataToAssert);
        $response->assertSuccessful();
    }

    /**
     * @param int $count
     * @param bool $media
     * @return Collection
     */
    private function setActivities($count = 1, $media = true): Collection
    {
        $this->setCategories(4);

        $this->activities = Activity::factory()
            ->count($count)
            ->create()
            ->each(
                function ($activity) {
                    $activity->categories()->attach($this->categories->random(2)->pluck('id')->toArray());
                    if ($this->seedContents) {
                        $this->setContents($activity);
                    }
                }
            );

        if ($media) {
            $this->activities->each(
                static function ($activity) {
                    $activity->media()->save(Media::factory()->make());
                }
            )->load('media');
        }

        return $this->activities;
    }

    /**
     * @param int $count
     */
    protected function setCategories($count = 1): void
    {
        $this->categories = ActivityCategory::factory()->count($count)->create();
    }

    /**
     * @param $activity
     */
    private function setContents($activity): void
    {
        $toInsert = [];
        $this->contents = collect();

        TextContent::factory()
            ->count(3)
            ->create()
            ->each(
                function ($textContent) {
                    $this->contents->push($textContent);
                }
            );

        RichTextContent::factory()
            ->count(3)
            ->create()
            ->each(
                function ($markdownContent) {
                    $this->contents->push($markdownContent);
                }
            );

        ImageContent::factory()
            ->count(3)
            ->create()
            ->each(
                function ($imageContent) {
                    $this->contents->push($imageContent);
                }
            );

        VideoContent::factory()
            ->count(3)
            ->create()
            ->each(
                function ($videoContent) {
                    $this->contents->push($videoContent);
                }
            );

        $this->contents->each(
            static function ($content) use (&$toInsert, $activity) {
                $toInsert[] = [
                    'containable_type' => Activity::class,
                    'containable_id' => $activity->id,
                    'contentable_type' => get_class($content),
                    'contentable_id' => $content->id
                ];
            }
        );

        DB::table('contents')->insert($toInsert);
    }

    /**
     * @param null $activities
     * @param int $count
     * @return array
     */
    private function prepareActivitiesToAssert($count = 1, $activities = null): array
    {
        $activities = $activities ?? $this->setActivities($count);

        return $activities->transform(
            function ($activity) {
                $data = [
                    'position' => $activity->position,
                    'title' => $activity->title,
                    'description' => $activity->description,
                    'slug' => $activity->slug,
                    'categories' => $activity->categories->transform(
                        static function ($category) {
                            return ['name' => $category->name, 'slug' => $category->slug];
                        }
                    )->toArray(),
                    'image' => $activity->firstMediaUrl(),
                    'image_meta' => $activity->firstMediaMeta()
                ];

                if ($this->seedContents) {
                    $data['content'] = $this->prepareContents();
                }

                return $data;
            }
        )->values()->toArray();
    }

    /**
     * @param $category
     * @return Collection
     */
    private function prepareActivityToAssertByCategory($category): Collection
    {
        $activities = $this->activities ?? $this->setActivities(5);

        return $activities->filter(
            function ($activity) use ($category) {
                return $activity->categories->contains('slug', $category->slug);
            }
        );
    }

    /**
     * @return array
     */
    private function prepareContents(): array
    {
        return $this->contents->transform(
            static function ($content) {
                $response = [
                    'content_type' => $content->content_type
                ];

                return array_merge($response, $content->getResponseData());
            }
        )->toArray();
    }
}
