<?php

namespace Feature\Controllers;

use App\Models\Activity;
use App\Models\ActivityCategory;
use App\Models\Media;
use App\Models\StaticComponent;
use Database\Factories\ActivityFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\ContentTestCase;
use Tests\TestHelpers\MediaAssert;

class ActivityControllerTest extends ContentTestCase
{
    use MediaAssert;

    /** @var Collection $activities */
    private $activities;

    /** @var Collection $activityCategories */
    private $activityCategories;

    /**
     * @test
     */
    public function it_shows_activities_view_on_index(): void
    {
        // act
        $response = $this->get(route('activities.index'));

        // assert
        $response->assertSuccessful();
        $response->assertViewIs('admin.activities.index');
    }

    /**
     * @test
     */
    public function it_shows_activities_data_on_index(): void
    {
        // arrange
        $this->setActivities(5, false);

        // act
        $response = $this->json('get', route('activities.data'));
        $data = $response->getData()->data;

        // assert
        $response->assertSuccessful();
        foreach ($this->activities as $key => $activity) {
            self::assertEquals($activity->title, $data[$key]->title);
            self::assertEquals($activity->description, $data[$key]->description);
        }
    }

    /**
     * @test
     */
    public function it_shows_activities_data_by_category_on_index(): void
    {
        // arrange
        $this->setActivities(5, false);

        $categoryId = $this->activityCategories->first()->id;
        $activities = $this->activities->filter(
            function ($activity) use ($categoryId) {
                return $activity->categories->where('id', $categoryId)->isNotEmpty();
            }
        )->values();

        // act
        $response = $this->json('get', route('activities.data', ['categoryId' => $categoryId]));
        $data = $response->getData()->data;

        // assert
        $response->assertSuccessful();
        foreach ($activities as $key => $activity) {
            self::assertEquals($activity->title, $data[$key]->title);
            self::assertEquals($activity->description, $data[$key]->description);
        }
    }

    /**
     * @test
     */
    public function it_fails_to_show_activities_on_index_no_authorization(): void
    {
        // arrange
        $this->logoutUser();

        // act
        $response = $this->get(route('activities.index'));

        // assert
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function it_shows_activities_on_show_page(): void
    {
        // arrange
        $this->setActivities();
        $activity = $this->activities->first();

        // act
        $response = $this->get(route('activities.show', $activity->id));
        $data = $response->viewData('activity');

        // assert
        $response->assertSuccessful();
        $response->assertViewIs('admin.activities.show');
        self::assertEquals($activity->title, $data->title);
        self::assertEquals($activity->description, $data->description);
        self::assertEquals($activity->categories->toArray(), $data->categories->toArray());
        self::assertEquals($activity->firstMediaUrl(), $data->firstMediaUrl());
        self::assertEquals($activity->firstMediaMeta(), $data->firstMediaMeta());
    }

    /**
     * @test
     */
    public function it_fails_to_show_activity_on_show_page_no_authorization(): void
    {
        // arrange
        $this->logoutUser();

        // act
        $response = $this->get(route('activities.show', 1));

        // assert
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function it_shows_activity_on_edit_page(): void
    {
        // arrange
        $this->setActivities(2);
        $activity = $this->activities->first();

        // act
        $response = $this->get(route('activities.edit', $activity->id));
        $data = $response->viewData('activity');

        // assert
        $response->assertSuccessful();
        $response->assertViewIs('admin.activities.edit');
        $response->assertViewHas('activity');
        self::assertEquals($activity->title, $data->title);
        self::assertEquals($activity->description, $data->description);
        self::assertEquals($activity->date, $data->date);
        self::assertEquals($activity->categories->toArray(), $data->categories->toArray());
        self::assertEquals($activity->firstMediaUrl(), $data->firstMediaUrl());
        self::assertEquals($activity->firstMediaMeta(), $data->firstMediaMeta());
    }

    /**
     * @test
     */
    public function it_fails_to_show_edit_page_no_authorization(): void
    {
        // arrange
        $this->logoutUser();

        // act
        $response = $this->get(route('activities.edit', 1));

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
        $response = $this->get(route('activities.create'));

        // assert
        $response->assertSuccessful();
        $response->assertViewIs('admin.activities.create');
    }

    /**
     * @test
     */
    public function it_fails_to_show_create_page_no_authorization(): void
    {
        // arrange
        $this->logoutUser();

        // act
        $response = $this->get(route('activities.create'));

        // assert
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function it_creates_activity_with_image(): void
    {
        // arrange
        Storage::fake('public');
        $this->setActivityComponent();
        $this->setActivityCategories(4);
        $categories = $this->activityCategories->random(2)->pluck('id')->toArray();
        $data = [
            'published' => 1,
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
        $response = $this->post(route('activities.store'), $data);

        // assert
        $response->assertRedirect(route('activities.show', 1));
        $this->assertMediaExists(Activity::first()->firstMedia());
        $this->assertDatabaseHas('activities', $expectedData);
        foreach ($categories as $category) {
            $this->assertDatabaseHas(
                'activity_activity_category',
                ['activity_category_id' => $category, 'activity_id' => 1]
            );
        }
    }

    /**
     * @test
     */
    public function it_creates_activity_with_existing_image(): void
    {
        // arrange
        $this->setActivityComponent();
        $this->setActivities(2);
        $this->setActivityCategories(4);
        $categories = $this->activityCategories->random(2)->pluck('id')->toArray();
        $media = $this->activities->first()->firstMedia();
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
            'mediable_type' => Activity::class,
            'mediable_id' => 3
        ];

        // act
        $response = $this->post(route('activities.store'), $data);

        // assert
        $response->assertRedirect(route('activities.show', 3));
        $this->assertDatabaseHas('activities', $expectedData);
        $this->assertDatabaseHas('mediables', $expectedMediaData);
        foreach ($categories as $category) {
            $this->assertDatabaseHas(
                'activity_activity_category',
                ['activity_category_id' => $category, 'activity_id' => 3]
            );
        }
    }

    /**
     * @test
     */
    public function it_fails_to_create_activity_no_required_fields(): void
    {
        // arrange
        $data = [];

        // act
        $response = $this->post(route('activities.store'), $data);

        // assert
        $response->assertSessionHasErrors(['title', 'description', 'categories']);
    }

    /**
     * @test
     */
    public function it_fails_to_create_activity_no_authorization(): void
    {
        // arrange
        $this->logoutUser();

        // act
        $response = $this->post(route('activities.store'), []);

        // assert
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function it_updates_activity(): void
    {
        // arrange
        $this->setActivities(1, false);
        $activity = $this->activities->first();
        $this->setActivityCategories(4);
        $categories = $this->activityCategories->random(2)->pluck('id')->toArray();
        $data = [
            'title' => 'Title',
            'description' => 'description',
            'categories' => $categories
        ];
        $expectedData = [
            'id' => $activity->id,
            'title' => $data['title'],
            'description' => $data['description'],
        ];
        // act
        $response = $this->put(route('activities.update', $activity->id), $data);

        // assert
        $response->assertRedirect(route('activities.show', $activity->id));
        $this->assertDatabaseHas('activities', $expectedData);
        foreach ($categories as $category) {
            $this->assertDatabaseHas(
                'activity_activity_category',
                ['activity_category_id' => $category, 'activity_id' => 1]
            );
        }
    }

    /**
     * @test
     */
    public function it_updates_activity_with_image(): void
    {
        // arrange
        $this->setActivities();
        $activity = $this->activities->first();
        $this->setActivityCategories(4);
        $categories = $this->activityCategories->random(2)->pluck('id')->toArray();
        $data = [
            'title' => 'Title',
            'description' => 'description',
            'image' => UploadedFile::fake()->image('photo1.jpg'),
            'categories' => $categories
        ];
        $expectedData = [
            'id' => $activity->id,
            'title' => $data['title'],
            'description' => $data['description'],
        ];
        $expectedMediaData = [
            'media_id' => 2,
            'mediable_type' => Activity::class,
            'mediable_id' => $activity->id
        ];

        // act
        $response = $this->put(route('activities.update', $activity->id), $data);

        // assert
        $response->assertRedirect(route('activities.show', $activity->id));
        $this->assertDatabaseHas('activities', $expectedData);
        $this->assertDatabaseHas('mediables', $expectedMediaData);
        $this->assertMediaExists($activity->load('media')->firstMedia());
        foreach ($categories as $category) {
            $this->assertDatabaseHas(
                'activity_activity_category',
                ['activity_category_id' => $category, 'activity_id' => 1]
            );
        }
    }

    /**
     * @test
     */
    public function it_updates_activity_with_existing_image(): void
    {
        // arrange
        $this->setActivities(2);

        $activity = $this->activities->first();
        $media = $this->activities->find(2)->firstMedia();
        $this->setActivityCategories(4);
        $categories = $this->activityCategories->random(2)->pluck('id')->toArray();
        $data = [
            'title' => 'Title',
            'description' => 'description',
            'media_id' => $media->id,
            'categories' => $categories
        ];
        $expectedData = [
            'id' => $activity->id,
            'title' => $data['title'],
            'description' => $data['description']
        ];
        $expectedMediaData = [
            'media_id' => $media->id,
            'mediable_type' => Activity::class,
            'mediable_id' => $activity->id
        ];

        // act
        $response = $this->put(route('activities.update', $activity->id), $data);

        // assert
        $response->assertRedirect(route('activities.show', $activity->id));
        $this->assertDatabaseHas('activities', $expectedData);
        $this->assertDatabaseHas('mediables', $expectedMediaData);
        foreach ($categories as $category) {
            $this->assertDatabaseHas(
                'activity_activity_category',
                ['activity_category_id' => $category, 'activity_id' => 1]
            );
        }
    }

    /**
     * @test
     */
    public function it_fails_to_update_activity_no_required_fields(): void
    {
        // arrange
        $this->setActivities();
        $activity = $this->activities->first();
        $data = [];

        // act
        $response = $this->put(route('activities.update', $activity->id), $data);

        // assert
        $response->assertSessionHasErrors(['title', 'description', 'categories']);
    }

    /**
     * @test
     */
    public function it_fails_to_update_activity_if_image_deleted(): void
    {
        // arrange
        $this->setActivities(1, false);
        $activity = $this->activities->first();
        $data = [
            'title' => 'Title',
            'description' => 'description',
            'deleted' => true,
        ];

        // act
        $response = $this->put(route('activities.update', $activity->id), $data);

        // assert
        $response->assertSessionHasErrors(['image']);
    }

    /**
     * @test
     */
    public function it_fails_to_update_activity_no_authorization(): void
    {
        // arrange
        $this->logoutUser();

        // act
        $response = $this->put(route('activities.update', 1), []);

        // assert
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function it_reorders_activities(): void
    {
        // arrange
        $this->setActivities(2);

        $data = ['items' => [['new' => 1, 'old' => 2], ['new' => 2, 'old' => 1]]];
        $expectedData = [
            ['id' => 1, 'position' => 2],
            ['id' => 2, 'position' => 1]
        ];

        // arrange
        $this->post(route('activities.reorder'), $data);

        // assert
        $this->assertDatabaseHas('activities', $expectedData[0]);
        $this->assertDatabaseHas('activities', $expectedData[1]);
    }

    /**
     * @test
     */
    public function it_fails_to_reorder_activities_no_required_sort_order(): void
    {
        // arrange
        $this->setActivities(2);
        $data = ['items' => [['new' => 99, 'old' => 98], ['new' => 97, 'old' => 98]]];

        // arrange
        $response = $this->post(route('activities.reorder'), $data);

        // assert
        $response->assertSessionHasErrors(['items.0.new', 'items.1.new', 'items.0.old', 'items.1.old']);
    }

    /**
     * @test
     */
    public function it_deletes_activity(): void
    {
        // arrange
        $this->setActivities();
        $activity = $this->activities->first();

        // act
        $response = $this->delete(route('activities.destroy', $activity->id));

        // assert
        $this->assertDatabaseMissing('activities', ['id' => $activity->id]);
        $response->assertRedirect(route('activities.index'));
    }

    /**
     * @test
     */
    public function it_fails_to_delete_activity_no_authorization(): void
    {
        // arrange
        $this->logoutUser();

        // act
        $response = $this->delete(route('activities.destroy', 1));

        // assert
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * @param int $count
     * @param bool $media
     */
    private function setActivities($count = 1, $media = true): void
    {
        $this->setActivityCategories(4);

        ActivityFactory::resetPosition();
        $this->activities = Activity::factory()
            ->count($count)
            ->create()
            ->each(
                function ($activity) {
                    $activity->categories()->attach($this->activityCategories->random(2)->pluck('id')->toArray());
                }
            );

        if ($media) {
            $this->activities->each(
                static function ($activity) {
                    $activity->media()->save(Media::factory()->make());
                }
            )->load('media');
        }
    }

    /**
     * @param int $count
     */
    protected function setActivityCategories($count = 1): void
    {
        $this->activityCategories = ActivityCategory::factory()->count($count)->create();
    }

    /**
     * @return void
     */
    protected function setActivityComponent(): void
    {
        StaticComponent::factory(['type' => 'activity'])->create();
    }
}
