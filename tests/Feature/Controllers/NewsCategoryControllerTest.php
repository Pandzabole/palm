<?php

namespace Feature\Controllers;

use App\Models\NewsCategory;
use Illuminate\Database\Eloquent\Collection;
use Tests\ContentTestCase;

class NewsCategoryControllerTest extends ContentTestCase
{
    /**
     * @test
     */
    public function it_shows_news_categories_view_on_index(): void
    {
        // act
        $response = $this->get(route('news-categories.index'));

        // assert
        $response->assertSuccessful();
        $response->assertViewIs('admin.news-categories.index');
    }

    /**
     * @test
     */
    public function it_shows_news_categories_data_on_index(): void
    {
        // arrange
        $newsCategories = $this->setNewsCategories(5);

        // act
        $response = $this->json('get', route('news-categories.data'));
        $data = $response->getData()->data;

        // assert
        $response->assertSuccessful();
        foreach ($newsCategories as $key => $news) {
            self::assertEquals($news->name, $data[$key]->name);
        }
    }

    /**
     * @test
     */
    public function it_fails_to_show_news_categories_on_index_no_authorization(): void
    {
        // arrange
        $this->logoutUser();

        // act
        $response = $this->get(route('news-categories.index'));

        // assert
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function it_shows_news_categories_on_show_page(): void
    {
        // arrange
        $newsCategories = $this->setNewsCategories();
        $newsCategory = $newsCategories->first();

        // act
        $response = $this->get(route('news-categories.show', $newsCategory->id));
        $data = $response->viewData('newsCategory');

        // assert
        $response->assertSuccessful();
        $response->assertViewIs('admin.news-categories.show');
        self::assertEquals($newsCategory->name, $data->name);
    }

    /**
     * @test
     */
    public function it_fails_to_show_news_categories_on_show_page_no_authorization(): void
    {
        // arrange
        $this->logoutUser();

        // act
        $response = $this->get(route('news-categories.show', 1));

        // assert
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function it_shows_news_categories_on_edit_page(): void
    {
        // arrange
        $newsCategories = $this->setNewsCategories(2);
        $newsCategory = $newsCategories->first();

        // act
        $response = $this->get(route('news-categories.edit', $newsCategory->id));
        $data = $response->viewData('newsCategory');

        // assert
        $response->assertSuccessful();
        $response->assertViewIs('admin.news-categories.edit');
        $response->assertViewHas('newsCategory');
        self::assertEquals($newsCategory->name, $data->name);
    }

    /**
     * @test
     */
    public function it_fails_to_show_edit_page_no_authorization(): void
    {
        // arrange
        $this->logoutUser();

        // act
        $response = $this->get(route('news-categories.edit', 1));

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
        $response = $this->get(route('news-categories.create'));

        // assert
        $response->assertSuccessful();
        $response->assertViewIs('admin.news-categories.create');
    }

    /**
     * @test
     */
    public function it_fails_to_show_create_page_no_authorization(): void
    {
        // arrange
        $this->logoutUser();

        // act
        $response = $this->get(route('news-categories.create'));

        // assert
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function it_creates_news_category(): void
    {
        // arrange
        $data = [
            'name' => 'Name'
        ];

        // act
        $response = $this->post(route('news-categories.store'), $data);

        // assert
        $response->assertRedirect(route('news-categories.show', 1));
        $this->assertDatabaseHas('news_categories', $data);
    }

    /**
     * @test
     */
    public function it_fails_to_create_news_category_no_required_fields(): void
    {
        // arrange
        $data = [];

        // act
        $response = $this->post(route('news-categories.store'), $data);

        // assert
        $response->assertSessionHasErrors(['name']);
    }

    /**
     * @test
     */
    public function it_fails_to_create_news_categories_no_authorization(): void
    {
        // arrange
        $this->logoutUser();

        // act
        $response = $this->post(route('news-categories.store'), []);

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
        $newsCategories = $this->setNewsCategories();
        $newsCategory = $newsCategories->first();
        $data = [
            'name' => 'name',
        ];
        $expectedData = [
            'id' => $newsCategory->id,
            'name' => $data['name'],
        ];
        // act
        $response = $this->put(route('news-categories.update', $newsCategory->id), $data);

        // assert
        $response->assertRedirect(route('news-categories.show', $newsCategory->id));
        $this->assertDatabaseHas('news_categories', $expectedData);
    }

    /**
     * @test
     */
    public function it_fails_to_update_news_category_no_required_fields(): void
    {
        // arrange
        $newsCategories = $this->setNewsCategories();
        $newsCategory = $newsCategories->first();
        $data = [];

        // act
        $response = $this->put(route('news-categories.update', $newsCategory->id), $data);

        // assert
        $response->assertSessionHasErrors(['name']);
    }

    /**
     * @test
     */
    public function it_fails_to_update_news_category_no_authorization(): void
    {
        // arrange
        $this->logoutUser();

        // act
        $response = $this->put(route('news-categories.update', 1), []);

        // assert
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function it_deletes_news_category(): void
    {
        // arrange
        $newsCategories = $this->setNewsCategories();
        $newsCategory = $newsCategories->first();

        // act
        $response = $this->delete(route('news-categories.destroy', $newsCategory->id));

        // assert
        $this->assertDatabaseMissing('news_categories', ['id' => $newsCategory->id]);
        $response->assertRedirect(route('news-categories.index'));
    }

    /**
     * @test
     */
    public function it_fails_to_delete_news_categories_no_authorization(): void
    {
        // arrange
        $this->logoutUser();

        // act
        $response = $this->delete(route('news-categories.destroy', 1));

        // assert
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * @param int $count
     * @return Collection
     */
    private function setNewsCategories($count = 1): Collection
    {
        return NewsCategory::factory()->count($count)->create();
    }
}
