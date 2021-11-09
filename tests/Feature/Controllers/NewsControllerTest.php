<?php

namespace Feature\Controllers;

use App\Models\Media;
use App\Models\News;
use App\Models\NewsCategory;
use App\Models\StaticComponent;
use Database\Factories\NewsFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\ContentTestCase;
use Tests\TestHelpers\MediaAssert;

class NewsControllerTest extends ContentTestCase
{
    use MediaAssert;

    /** @var Collection $news */
    private $news;

    /** @var Collection $newsCategories */
    private $newsCategories;

    /**
     * @test
     */
    public function it_shows_news_view_on_index(): void
    {
        // act
        $response = $this->get(route('news.index'));

        // assert
        $response->assertSuccessful();
        $response->assertViewIs('admin.news.index');
    }

    /**
     * @test
     */
    public function it_shows_news_data_on_index(): void
    {
        // arrange
        $this->setNews(5, false);

        // act
        $response = $this->json('get', route('news.data'));
        $data = $response->getData()->data;

        // assert
        $response->assertSuccessful();
        foreach ($this->news as $key => $news) {
            self::assertEquals($news->title, $data[$key]->title);
            self::assertEquals($news->description, $data[$key]->description);
        }
    }

    /**
     * @test
     */
    public function it_shows_activities_data_by_category_on_index(): void
    {
        // arrange
        $this->setNews(5, false);

        $categoryId = $this->newsCategories->first()->id;
        $news = $this->news->filter(
            function ($news) use ($categoryId) {
                return $news->categories->where('id', $categoryId)->isNotEmpty();
            }
        )->values();

        // act
        $response = $this->json('get', route('news.data', ['categoryId' => $categoryId]));
        $data = $response->getData()->data;

        // assert
        $response->assertSuccessful();
        foreach ($news as $key => $news) {
            self::assertEquals($news->title, $data[$key]->title);
            self::assertEquals($news->description, $data[$key]->description);
        }
    }

    /**
     * @test
     */
    public function it_fails_to_show_news_on_index_no_authorization(): void
    {
        // arrange
        $this->logoutUser();

        // act
        $response = $this->get(route('news.index'));

        // assert
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function it_shows_news_on_show_page(): void
    {
        // arrange
        $this->setNews();
        $news = $this->news->first();

        // act
        $response = $this->get(route('news.show', $news->id));
        $data = $response->viewData('news');

        // assert
        $response->assertSuccessful();
        $response->assertViewIs('admin.news.show');
        self::assertEquals($news->title, $data->title);
        self::assertEquals($news->description, $data->description);
        self::assertEquals($news->categories->toArray(), $data->categories->toArray());
        self::assertEquals($news->firstMediaUrl(), $data->firstMediaUrl());
        self::assertEquals($news->firstMediaMeta(), $data->firstMediaMeta());
    }

    /**
     * @test
     */
    public function it_fails_to_show_news_on_show_page_no_authorization(): void
    {
        // arrange
        $this->logoutUser();

        // act
        $response = $this->get(route('news.show', 1));

        // assert
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function it_shows_news_on_edit_page(): void
    {
        // arrange
        $this->setNews(2);
        $news = $this->news->first();

        // act
        $response = $this->get(route('news.edit', $news->id));
        $data = $response->viewData('news');

        // assert
        $response->assertSuccessful();
        $response->assertViewIs('admin.news.edit');
        $response->assertViewHas('news');
        self::assertEquals($news->title, $data->title);
        self::assertEquals($news->date, $data->date);
        self::assertEquals($news->categories->toArray(), $data->categories->toArray());
        self::assertEquals($news->firstMediaUrl(), $data->firstMediaUrl());
        self::assertEquals($news->firstMediaMeta(), $data->firstMediaMeta());
    }

    /**
     * @test
     */
    public function it_fails_to_show_edit_page_no_authorization(): void
    {
        // arrange
        $this->logoutUser();

        // act
        $response = $this->get(route('news.edit', 1));

        // assert
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function it_shows_create_page(): void
    {
        // act
        $response = $this->get(route('news.create'));

        // assert
        $response->assertSuccessful();
        $response->assertViewIs('admin.news.create');
    }

    /**
     * @test
     */
    public function it_fails_to_show_create_page_no_authorization(): void
    {
        // arrange
        $this->logoutUser();

        // act
        $response = $this->get(route('news.create'));

        // assert
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function it_creates_news_with_image(): void
    {
        // arrange
        Storage::fake('public');
        $this->setNewsComponent();
        $this->setNewsCategories(4);
        $categories = $this->newsCategories->random(2)->pluck('id')->toArray();
        $data = [
            'title' => 'Title',
            'description' => 'description',
            'image' => UploadedFile::fake()->image('photo1.jpg'),
            'categories' => $categories
        ];
        $expectedData = [
            'title' => 'Title',
            'description' => 'description'
        ];

        // act
        $response = $this->post(route('news.store'), $data);

        // assert
        $response->assertRedirect(route('news.show', 1));
        $this->assertMediaExists(News::first()->firstMedia());
        $this->assertDatabaseHas('news', $expectedData);
        foreach ($categories as $category) {
            $this->assertDatabaseHas('news_news_category', ['news_category_id' => $category, 'news_id' => 1]);
        }
    }

    /**
     * @test
     */
    public function it_creates_news_with_existing_image(): void
    {
        // arrange
        $this->setNewsComponent();
        $this->setNews(2);
        $this->setNewsCategories(4);
        $categories = $this->newsCategories->random(2)->pluck('id')->toArray();
        $media = $this->news->first()->firstMedia();
        $data = [
            'title' => 'Title',
            'description' => 'description',
            'media_id' => $media->id,
            'categories' => $categories
        ];
        $expectedData = [
            'title' => 'Title',
            'description' => 'description',
        ];
        $expectedMediaData = [
            'media_id' => $media->id,
            'mediable_type' => News::class,
            'mediable_id' => 3
        ];

        // act
        $response = $this->post(route('news.store'), $data);

        // assert
        $response->assertRedirect(route('news.show', 3));
        $this->assertDatabaseHas('news', $expectedData);
        $this->assertDatabaseHas('mediables', $expectedMediaData);
        foreach ($categories as $category) {
            $this->assertDatabaseHas('news_news_category', ['news_category_id' => $category, 'news_id' => 3]);
        }
    }

    /**
     * @test
     */
    public function it_fails_to_create_news_no_required_fields(): void
    {
        // arrange
        $data = [];

        // act
        $response = $this->post(route('news.store'), $data);

        // assert
        $response->assertSessionHasErrors(['title', 'description', 'categories']);
    }

    /**
     * @test
     */
    public function it_fails_to_create_news_no_authorization(): void
    {
        // arrange
        $this->logoutUser();

        // act
        $response = $this->post(route('news.store'), []);

        // assert
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function it_updates_news(): void
    {
        // arrange
        $this->setNews(1, false);
        $news = $this->news->first();
        $this->setNewsCategories(4);
        $categories = $this->newsCategories->random(2)->pluck('id')->toArray();
        $data = [
            'title' => 'Title',
            'description' => 'description',
            'categories' => $categories
        ];
        $expectedData = [
            'id' => $news->id,
            'title' => $data['title'],
            'description' => $data['description'],
        ];
        // act
        $response = $this->put(route('news.update', $news->id), $data);

        // assert
        $response->assertRedirect(route('news.show', $news->id));
        $this->assertDatabaseHas('news', $expectedData);
        foreach ($categories as $category) {
            $this->assertDatabaseHas('news_news_category', ['news_category_id' => $category, 'news_id' => 1]);
        }
    }

    /**
     * @test
     */
    public function it_updates_news_with_image(): void
    {
        // arrange
        $this->setNews();
        $news = $this->news->first();
        $this->setNewsCategories(4);
        $categories = $this->newsCategories->random(2)->pluck('id')->toArray();
        $data = [
            'title' => 'Title',
            'description' => 'description',
            'image' => UploadedFile::fake()->image('photo1.jpg'),
            'categories' => $categories
        ];
        $expectedData = [
            'id' => $news->id,
            'title' => $data['title'],
            'description' => $data['description'],
        ];
        $expectedMediaData = [
            'media_id' => 2,
            'mediable_type' => News::class,
            'mediable_id' => $news->id
        ];

        // act
        $response = $this->put(route('news.update', $news->id), $data);

        // assert
        $response->assertRedirect(route('news.show', $news->id));
        $this->assertDatabaseHas('news', $expectedData);
        $this->assertDatabaseHas('mediables', $expectedMediaData);
        $this->assertMediaExists($news->load('media')->firstMedia());
        foreach ($categories as $category) {
            $this->assertDatabaseHas('news_news_category', ['news_category_id' => $category, 'news_id' => 1]);
        }
    }

    /**
     * @test
     */
    public function it_updates_news_with_existing_image(): void
    {
        // arrange
        $this->setNews(2);

        $news = $this->news->first();
        $media = $this->news->find(2)->firstMedia();
        $this->setNewsCategories(4);
        $categories = $this->newsCategories->random(2)->pluck('id')->toArray();
        $data = [
            'title' => 'Title',
            'description' => 'description',
            'media_id' => $media->id,
            'categories' => $categories
        ];
        $expectedData = [
            'id' => $news->id,
            'title' => $data['title'],
            'description' => $data['description']
        ];
        $expectedMediaData = [
            'media_id' => $media->id,
            'mediable_type' => News::class,
            'mediable_id' => $news->id
        ];

        // act
        $response = $this->put(route('news.update', $news->id), $data);

        // assert
        $response->assertRedirect(route('news.show', $news->id));
        $this->assertDatabaseHas('news', $expectedData);
        $this->assertDatabaseHas('mediables', $expectedMediaData);
        foreach ($categories as $category) {
            $this->assertDatabaseHas('news_news_category', ['news_category_id' => $category, 'news_id' => 1]);
        }
    }

    /**
     * @test
     */
    public function it_fails_to_update_news_no_required_fields(): void
    {
        // arrange
        $this->setNews();
        $news = $this->news->first();
        $data = [];

        // act
        $response = $this->put(route('news.update', $news->id), $data);

        // assert
        $response->assertSessionHasErrors(['title', 'description', 'categories']);
    }

    /**
     * @test
     */
    public function it_fails_to_update_news_if_image_deleted(): void
    {
        // arrange
        $this->setNews(1, false);
        $news = $this->news->first();
        $data = [
            'title' => 'Title',
            'description' => 'description',
            'deleted' => true,
        ];

        // act
        $response = $this->put(route('news.update', $news->id), $data);

        // assert
        $response->assertSessionHasErrors(['image']);
    }

    /**
     * @test
     */
    public function it_fails_to_update_news_no_authorization(): void
    {
        // arrange
        $this->logoutUser();

        // act
        $response = $this->put(route('news.update', 1), []);

        // assert
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function it_deletes_news(): void
    {
        // arrange
        $this->setNews();
        $news = $this->news->first();

        // act
        $response = $this->delete(route('news.destroy', $news->id));

        // assert
        $this->assertDatabaseMissing('news', ['id' => $news->id]);
        $response->assertRedirect(route('news.index'));
    }

    /**
     * @test
     */
    public function it_fails_to_delete_news_no_authorization(): void
    {
        // arrange
        $this->logoutUser();

        // act
        $response = $this->delete(route('news.destroy', 1));

        // assert
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function it_reorders_news(): void
    {
        // arrange
        $this->setNews(2);

        $data = ['items' => [['new' => 1, 'old' => 2], ['new' => 2, 'old' => 1]]];
        $expectedData = [
            ['id' => 1, 'position' => 2],
            ['id' => 2, 'position' => 1]
        ];

        // arrange
        $this->post(route('news.reorder'), $data);

        // assert
        $this->assertDatabaseHas('news', $expectedData[0]);
        $this->assertDatabaseHas('news', $expectedData[1]);
    }

    /**
     * @test
     */
    public function it_fails_to_reorder_news_no_required_sort_order(): void
    {
        // arrange
        $this->setNews(2);
        $data = ['items' => [['new' => 99, 'old' => 98], ['new' => 97, 'old' => 98]]];

        // arrange
        $response = $this->post(route('news.reorder'), $data);

        // assert
        $response->assertSessionHasErrors(['items.0.new', 'items.1.new', 'items.0.old', 'items.1.old']);
    }

    /**
     * @test
     */
    public function it_highlights_news(): void
    {
        // arrange
        $this->setNews(3);
        $news = $this->news->last();
        $dataToAssert = [
            ['id' => 1, 'highlighted' => false],
            ['id' => 2, 'highlighted' => false],
            ['id' => 3, 'highlighted' => true]
        ];

        // act
        $response = $this->get(route('news.highlight', $news->id));

        // assert
        foreach ($dataToAssert as $data) {
            $this->assertDatabaseHas('news', $data);
        }

        $response->assertRedirect(route('news.index'));
    }

    /**
     * @param int $count
     * @param bool $media
     */
    private function setNews($count = 1, $media = true): void
    {
        $this->setNewsCategories(4);
        NewsFactory::resetPosition();
        $this->news = News::factory()->count($count)->create()->each(
            function ($news) {
                $news->categories()->attach($this->newsCategories->random(2)->pluck('id')->toArray());
            }
        );

        if ($media) {
            $this->news->each(
                static function ($news) {
                    $news->media()->save(Media::factory()->make());
                }
            )->load('media');
        }
    }

    /**
     * @param int $count
     */
    protected function setNewsCategories($count = 1): void
    {
        $this->newsCategories = NewsCategory::factory()->count($count)->create();
    }

    /**
     * @return void
     */
    protected function setNewsComponent(): void
    {
        StaticComponent::factory(['type' => 'news'])->create();
    }
}
