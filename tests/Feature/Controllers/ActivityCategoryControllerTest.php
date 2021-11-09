<?php

namespace Feature\Controllers;

use App\Models\ActivityCategory;
use Illuminate\Database\Eloquent\Collection;
use Tests\ContentTestCase;

class ActivityCategoryControllerTest extends ContentTestCase
{
    /**
     * @test
     */
    public function it_shows_activity_categories_view_on_index(): void
    {
        // act
        $response = $this->get(route('activity-categories.index'));

        // assert
        $response->assertSuccessful();
        $response->assertViewIs('admin.activity-categories.index');
    }

    /**
     * @test
     */
    public function it_shows_activity_categories_data_on_index(): void
    {
        // arrange
        $activityCategories = $this->setActivityCategories(5);

        // act
        $response = $this->json('get', route('activity-categories.data'));
        $data = $response->getData()->data;

        // assert
        $response->assertSuccessful();
        foreach ($activityCategories as $key => $activity) {
            self::assertEquals($activity->name, $data[$key]->name);
        }
    }

    /**
     * @test
     */
    public function it_fails_to_show_activity_categories_on_index_no_authorization(): void
    {
        // arrange
        $this->logoutUser();

        // act
        $response = $this->get(route('activity-categories.index'));

        // assert
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function it_shows_activity_categories_on_show_page(): void
    {
        // arrange
        $activityCategories = $this->setActivityCategories();
        $activityCategory = $activityCategories->first();

        // act
        $response = $this->get(route('activity-categories.show', $activityCategory->id));
        $data = $response->viewData('activityCategory');

        // assert
        $response->assertSuccessful();
        $response->assertViewIs('admin.activity-categories.show');
        self::assertEquals($activityCategory->name, $data->name);
    }

    /**
     * @test
     */
    public function it_fails_to_show_activity_categories_on_show_page_no_authorization(): void
    {
        // arrange
        $this->logoutUser();

        // act
        $response = $this->get(route('activity-categories.show', 1));

        // assert
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function it_shows_activity_categories_on_edit_page(): void
    {
        // arrange
        $activityCategories = $this->setActivityCategories(2);
        $activityCategory = $activityCategories->first();

        // act
        $response = $this->get(route('activity-categories.edit', $activityCategory->id));
        $data = $response->viewData('activityCategory');

        // assert
        $response->assertSuccessful();
        $response->assertViewIs('admin.activity-categories.edit');
        $response->assertViewHas('activityCategory');
        self::assertEquals($activityCategory->name, $data->name);
    }

    /**
     * @test
     */
    public function it_fails_to_show_edit_page_no_authorization(): void
    {
        // arrange
        $this->logoutUser();

        // act
        $response = $this->get(route('activity-categories.edit', 1));

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
        $response = $this->get(route('activity-categories.create'));

        // assert
        $response->assertSuccessful();
        $response->assertViewIs('admin.activity-categories.create');
    }

    /**
     * @test
     */
    public function it_fails_to_show_create_page_no_authorization(): void
    {
        // arrange
        $this->logoutUser();

        // act
        $response = $this->get(route('activity-categories.create'));

        // assert
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function it_creates_activity_category(): void
    {
        // arrange
        $data = [
            'name' => 'Name'
        ];

        // act
        $response = $this->post(route('activity-categories.store'), $data);

        // assert
        $response->assertRedirect(route('activity-categories.show', 1));
        $this->assertDatabaseHas('activity_categories', $data);
    }

    /**
     * @test
     */
    public function it_fails_to_create_activity_category_no_required_fields(): void
    {
        // arrange
        $data = [];

        // act
        $response = $this->post(route('activity-categories.store'), $data);

        // assert
        $response->assertSessionHasErrors(['name']);
    }

    /**
     * @test
     */
    public function it_fails_to_create_activity_categories_no_authorization(): void
    {
        // arrange
        $this->logoutUser();

        // act
        $response = $this->post(route('activity-categories.store'), []);

        // assert
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function it_updates_news_category(): void
    {
        // arrange
        $activityCategories = $this->setActivityCategories();
        $activityCategory = $activityCategories->first();
        $data = [
            'name' => 'name',
        ];
        $expectedData = [
            'id' => $activityCategory->id,
            'name' => $data['name'],
        ];
        // act
        $response = $this->put(route('activity-categories.update', $activityCategory->id), $data);

        // assert
        $response->assertRedirect(route('activity-categories.show', $activityCategory->id));
        $this->assertDatabaseHas('activity_categories', $expectedData);
    }

    /**
     * @test
     */
    public function it_fails_to_update_activity_category_no_required_fields(): void
    {
        // arrange
        $activityCategories = $this->setActivityCategories();
        $activityCategory = $activityCategories->first();
        $data = [];

        // act
        $response = $this->put(route('activity-categories.update', $activityCategory->id), $data);

        // assert
        $response->assertSessionHasErrors(['name']);
    }

    /**
     * @test
     */
    public function it_fails_to_update_activity_category_no_authorization(): void
    {
        // arrange
        $this->logoutUser();

        // act
        $response = $this->put(route('activity-categories.update', 1), []);

        // assert
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function it_deletes_activity_category(): void
    {
        // arrange
        $activityCategories = $this->setActivityCategories();
        $activityCategory = $activityCategories->first();

        // act
        $response = $this->delete(route('activity-categories.destroy', $activityCategory->id));

        // assert
        $this->assertDatabaseMissing('activity_categories', ['id' => $activityCategory->id]);
        $response->assertRedirect(route('activity-categories.index'));
    }

    /**
     * @test
     */
    public function it_fails_to_delete_activity_categories_no_authorization(): void
    {
        // arrange
        $this->logoutUser();

        // act
        $response = $this->delete(route('activity-categories.destroy', 1));

        // assert
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * @param int $count
     * @return Collection
     */
    private function setActivityCategories($count = 1): Collection
    {
        return ActivityCategory::factory()->count($count)->create();
    }
}
