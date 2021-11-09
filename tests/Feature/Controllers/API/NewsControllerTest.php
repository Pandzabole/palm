<?php

namespace Feature\Controllers\API;

use App\Models\Content\ImageContent;
use App\Models\Content\RichTextContent;
use App\Models\Content\TextContent;
use App\Models\Content\VideoContent;
use App\Models\Media;
use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Tests\ContentTestCase;

class NewsControllerTest extends ContentTestCase
{
    /** @var Collection $news */
    private $news;

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
    public function it_returns_highlighted_news(): void
    {
        // arrange
        $dataToAssert = $this->prepareNewsToAssert()[0];

        // act
        $response = $this->getApiJsonResponse('news/highlighted');

        // assert
        $response->assertJson($dataToAssert);
        $response->assertSuccessful();
    }

    /**
     * @test
     * @return void
     */
    public function it_returns_news(): void
    {
        // arrange
        $dataToAssert = $this->prepareNewsToAssert(5);

        // act
        $response = $this->getApiJsonResponse('news');

        // assert
        self::assertEquals($dataToAssert, $response->getData(true));
        $response->assertSuccessful();
    }

    /**
     * @test
     * @return void
     */
    public function it_returns_news_paginated(): void
    {
        // arrange
        $dataStructure = ['news_items', 'links', 'meta'];
        $dataToAssert = $this->prepareNewsToAssert(5);

        // act
        $response = $this->getApiJsonResponse('news/paginate');

        // assert
        $response->assertJsonStructure($dataStructure);
        self::assertEquals($dataToAssert, $response->getData(true)['news_items']);
        $response->assertSuccessful();
    }

    /**
     * @test
     * @return void
     */
    public function it_returns_news_by_category_slug(): void
    {
        // arrange
        $this->setNews(5);
        $category = $this->categories->first();
        $news = $this->prepareNewsToAssertByCategory($category);
        $dataToAssert = $this->prepareNewsToAssert(5, $news);

        // act
        $response = $this->getApiJsonResponse('news', ['category' => $category->slug]);

        // assert
        self::assertEquals($dataToAssert, $response->getData(true));
        $response->assertSuccessful();
    }

    /**
     * @test
     * @return void
     */
    public function it_returns_news_paginated_by_category_slug(): void
    {
        // arrange
        $this->setNews(5);
        $category = $this->categories->first();
        $dataStructure = ['news_items', 'links', 'meta'];
        $news = $this->prepareNewsToAssertByCategory($category);
        $dataToAssert = $this->prepareNewsToAssert(5, $news);

        // act
        $response = $this->getApiJsonResponse('news/paginate', ['category' => $category->slug]);

        // assert
        $response->assertJsonStructure($dataStructure);
        self::assertEquals($dataToAssert, $response->getData(true)['news_items']);
        $response->assertSuccessful();
    }

    /**
     * @test
     * @return void
     */
    public function it_returns_single_news_by_slug(): void
    {
        // arrange
        $this->seedContents = true;
        $dataToAssert = $this->prepareNewsToAssert()[0];
        $news = $this->news->first();

        // act
        $response = $this->getApiJsonResponse('news/' . $news['slug']);

        // assert
        $response->assertJson($dataToAssert);
        $response->assertSuccessful();
    }

    /**
     * @test
     * @return void
     */
    public function it_returns_news_with_image_meta_base64(): void
    {
        // arrange
        $this->setNews();

        // act
        $response = $this->getApiJsonResponse('news');

        // assert
        $responseData = $response->getData(true)[0];
        $base64 = $responseData['image_meta']['base64'];
        self::assertNotEmpty($base64);
        $response->assertSuccessful();
    }

    /**
     * @param int $count
     * @param bool $media
     * @return Collection
     */
    private function setNews($count = 1, $media = true): Collection
    {
        $this->setCategories(4);

        $this->news = News::factory()
            ->count($count)
            ->create()
            ->each(
                function ($news) {
                    $news->categories()->attach($this->categories->random(2)->pluck('id')->toArray());
                    if ($this->seedContents) {
                        $this->setContents($news);
                    }
                }
            );

        if ($media) {
            $this->news->each(
                static function ($news) {
                    $news->media()->save(Media::factory()->make());
                }
            )->load('media');
        }

        return $this->news;
    }

    /**
     * @param int $count
     */
    protected function setCategories($count = 1): void
    {
        $this->categories = NewsCategory::factory()->count($count)->create();
    }

    /**
     * @param $news
     */
    private function setContents($news): void
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
            static function ($content) use (&$toInsert, $news) {
                $toInsert[] = [
                    'containable_type' => News::class,
                    'containable_id' => $news->id,
                    'contentable_type' => get_class($content),
                    'contentable_id' => $content->id
                ];
            }
        );

        DB::table('contents')->insert($toInsert);
    }

    /**
     * @param null $news
     * @param int $count
     * @return array
     */
    private function prepareNewsToAssert($count = 1, $news = null): array
    {
        $news = $news ?? $this->setNews($count);

        return $news->transform(
            function ($news) {
                $data = [
                    'position' => $news->position,
                    'title' => $news->title,
                    'description' => $news->description,
                    'highlighted' => $news->highlighted,
                    'date' => $news->created_at->format('d.m.Y'),
                    'slug' => $news->slug,
                    'categories' => $news->categories->transform(
                        static function ($category) {
                            return ['name' => $category->name, 'slug' => $category->slug];
                        }
                    )->toArray(),
                    'image' => $news->firstMediaUrl(),
                    'image_meta' => $news->firstMediaMeta()
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
    private function prepareNewsToAssertByCategory($category): Collection
    {
        $news = $this->news ?? $this->setNews(5);

        return $news->filter(
            function ($news) use ($category) {
                return $news->categories->contains('slug', $category->slug);
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
