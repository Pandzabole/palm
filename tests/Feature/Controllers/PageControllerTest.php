<?php

namespace Feature\Controllers;

use App\Models\Page;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Tests\ContentTestCase;
use Illuminate\Support\Collection;

class PageControllerTest extends ContentTestCase
{
    /**
     * @test
     */
    public function it_displays_pages_view_on_index_page(): void
    {
        // act
        $response = $this->get(route('pages.index'));

        // assert
        $response->assertSuccessful();
        $response->assertViewIs('admin.pages.index');
    }

    /**
     * @test
     */
    public function it_shows_pages_data_on_index(): void
    {
        // arrange
        $pages = $this->seedPages();

        // act
        $response = $this->json('get', route('pages.data'));
        $data = $response->getData()->data;

        // assert
        $response->assertSuccessful();
        foreach ($pages as $key => $page) {
            self::assertEquals($page->name, $data[$key]->name);
        }
    }

    /**
     * @test
     */
    public function it_can_not_display_pages_on_index_page_if_user_is_not_logged_in(): void
    {
        // arrange
        $this->logoutUser();

        // act
        $response = $this->get(route('pages.index'));

        // assert
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function it_displays_page_data_on_show_page(): void
    {
        // arrange
        $pages = $this->seedPages(5);
        $page = $pages->first();

        // act
        $response = $this->get(route('pages.show', $page->id));
        $data = $response->viewData('page');

        // assert
        $response->assertSuccessful();
        $response->assertViewIs('admin.pages.show');

        self::assertEquals($page->toArray(), $data->toArray());
    }

    /**
     * @test
     */
    public function it_can_not_display_page_on_show_page_if_user_is_not_logged_in(): void
    {
        // arrange
        $this->logoutUser();

        // act
        $response = $this->get(route('pages.show', 1));

        // assert
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function it_can_not_displays_non_existing_page_on_show_page(): void
    {
        // act
        $response = $this->get(route('pages.show', 200));

        // assert
        $response->assertStatus(404);
    }

    /**
     * @test
     */
    public function it_shows_page_on_edit_page(): void
    {
        // arrange
        $pages = $this->seedPages(3);
        $page = $pages->first();

        // act
        $response = $this->get(route('pages.edit', $page->id));
        $data = $response->viewData('page');

        // assert
        $response->assertSuccessful();
        $response->assertViewIs('admin.pages.edit');
        self::assertEquals($page->name, $data->name);
    }

    /**
     * @test
     */
    public function it_can_not_displays_page_on_edit_if_user_is_not_logged_in(): void
    {
        // arrange
        $this->logoutUser();

        // act
        $response = $this->get(route('pages.edit', 1));

        // assert
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function it_updates_required_fields_for_page(): void
    {
        // arrange
        $pages = $this->seedPages();
        $page = $pages->first();
        $data = ['name' => 'Test Name'];

        // act
        $this->put(route('pages.update', $page->id), $data);

        // assert
        $this->assertDatabaseHas('pages', ['name' => $data['name']]);
    }

    /**
     * @test
     */
    public function it_fails_to_update_page_data_no_required_fields(): void
    {
        // arrange
        $pages = $this->seedPages();
        $page = $pages->first();
        $data = ['name' => ''];

        // act
        $response = $this->put(route('pages.update', $page->id), $data);

        // assert
        $response->assertSessionHasErrors(['name']);
    }

    /**
     * @test
     */
    public function it_can_not_update_page_if_user_is_not_logged_in(): void
    {
        // arrange
        $this->logoutUser();

        // act
        $response = $this->put(route('pages.update', 1));

        // assert
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function it_can_not_create_new_page_route_no_exists(): void
    {
        // act
        $this->expectException(RouteNotFoundException::class);
        $this->get(route('pages.create'));
    }

    /**
     * @test
     */
    public function it_can_not_delete_page_route_no_exists(): void
    {
        // act
        $this->expectException(RouteNotFoundException::class);
        $this->get(route('pages.destroy'));
    }

    /**
     * It create page items
     *
     * @param int $count
     * @return Collection
     */
    private function seedPages(int $count = 1): Collection
    {
        return Page::factory()->count($count)->create();
    }
}
