<?php

namespace Feature\Controllers;

use App\Models\Media;
use App\Models\Page;
use App\Models\StaticComponent;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Tests\ContentTestCase;
use Tests\TestHelpers\MediaAssert;

class StaticComponentControllerTest extends ContentTestCase
{
    use MediaAssert;

    /**
     * @test
     */
    public function it_displays_page_components_on_show_page(): void
    {
        // arrange
        $pages = $this->seedPages();
        $page = $pages->first();
        $staticComponents = $page->staticComponent;

        // act
        $response = $this->get(route('components.show', $page->slug));

        // assert
        $response->assertSuccessful();
        $response->assertViewIs('admin.page-components.show');
        $data = $response->viewData('pageComponents');

        self::assertEquals($data->toArray(), $staticComponents->toArray());
    }

    /**
     * @test
     */
    public function it_can_not_display_page_component_on_show_no_authorization(): void
    {
        // arrange
        $this->logoutUser();

        // act
        $response = $this->get(route('components.show', 1));

        // assert
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function it_can_not_displays_non_existing_page_components_on_show_page(): void
    {
        // act
        $response = $this->get(route('components.show', 200));

        // assert
        $response->assertStatus(404);
    }

    /**
     * @test
     */
    public function it_displays_page_components_on_edit_page(): void
    {
        // arrange
        $pages = $this->seedPages();
        $page = $pages->first();
        $staticComponents = $page->staticComponent;

        // act
        $response = $this->get(route('components.edit', $page->slug));

        // assert
        $response->assertSuccessful();
        $response->assertViewIs('admin.page-components.edit');
        $data = $response->viewData('pageComponents');

        self::assertEquals($data->toArray(), $staticComponents->toArray());
    }

    /**
     * @test
     */
    public function it_can_not_displays_page_components_on_edit_no_authorization(): void
    {
        // arrange
        $this->logoutUser();

        // act
        $response = $this->get(route('components.edit', 1));

        // assert
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function it_updates_page_components(): void
    {
        // arrange
        $pages = $this->seedPages();
        $page = $pages->first();

        $data = [
            'components' => [
                1 => [
                    'id' => 1,
                    'tag' => 'Tag',
                    'primary_title' => 'Primary title',
                    'secondary_title' => 'Second title',
                    'sub_title' => 'Sub title',
                    'description' => 'Description',
                    'cta' => 'Cta'
                ]
            ]
        ];

        // act
        $this->put(route('components.update', $page->slug), $data);

        // assert
        $this->assertDatabaseHas('static_components', $data['components'][1]);
    }

    /**
     * @test
     */
    public function it_updates_page_components_with_media(): void
    {
        // arrange
        Storage::fake('public');
        $pages = $this->seedPages();
        $page = $pages->first();
        $staticComponent = $page->staticComponent->first();

        $data = [
            'components' => [
                $staticComponent->id => [
                    'id' => $staticComponent->id,
                    'tag' => 'Tag',
                    'primary_title' => 'Primary title',
                    'secondary_title' => 'Second title',
                    'sub_title' => 'Sub title',
                    'description' => 'Description',
                    'cta' => 'Cta',
                    'image_desktop' => new UploadedFile(
                        config('seeder.desktop'),
                        'desktop-image',
                        'image/png',
                        0,
                        true
                    ),
                    'image_mobile' => new UploadedFile(
                        config('seeder.mobile'),
                        'mobile-image',
                        'image/png',
                        0,
                        true
                    ),
                ]
            ]
        ];

        // act
        $this->put(route('components.update', $page->slug), $data);

        // assert
        $this->assertDatabaseHas(
            'static_components',
            Arr::except($data['components'][$staticComponent->id], ['image_desktop', 'image_mobile'])
        );

        $staticComponent->load('media');

        $mobileImage = $staticComponent->mobileImage();
        $desktopImage = $staticComponent->desktopImage();

        $this->assertMediaExists($mobileImage);
        $this->assertMediaExists($desktopImage);

        $this->assertDatabaseHas(
            'mediables',
            [
                'media_id' => $mobileImage->id,
                'mediable_type' => StaticComponent::class,
                'mediable_id' => $staticComponent->id
            ]
        );
        $this->assertDatabaseHas(
            'mediables',
            [
                'media_id' => $desktopImage->id,
                'mediable_type' => StaticComponent::class,
                'mediable_id' => $staticComponent->id
            ]
        );
    }

    /**
     * @test
     */
    public function it_updates_page_components_with_existing_media(): void
    {
        // arrange
        $pages = $this->seedPages();
        $page = $pages->first();
        $staticComponent = $page->staticComponent->first();
        $media = $this->seedMedia();
        $mobileImage = $media->firstWhere('config', 'mobile');
        $desktopImage = $media->firstWhere('config', 'desktop');

        $data = [
            'components' => [
                $staticComponent->id => [
                    'id' => $staticComponent->id,
                    'tag' => 'Tag',
                    'primary_title' => 'Primary title',
                    'secondary_title' => 'Second title',
                    'sub_title' => 'Sub title',
                    'description' => 'Description',
                    'cta' => 'Cta',
                    'media_desktop_id' => $desktopImage->id,
                    'media_mobile_id' => $mobileImage->id,
                ]
            ]
        ];

        // act
        $this->put(route('components.update', $page->slug), $data);

        // assert
        $this->assertDatabaseHas(
            'static_components',
            Arr::except($data['components'][$staticComponent->id], ['media_desktop_id', 'media_mobile_id'])
        );

        $this->assertDatabaseHas(
            'mediables',
            [
                'media_id' => $mobileImage->id,
                'mediable_type' => StaticComponent::class,
                'mediable_id' => $staticComponent->id
            ]
        );
        $this->assertDatabaseHas(
            'mediables',
            [
                'media_id' => $desktopImage->id,
                'mediable_type' => StaticComponent::class,
                'mediable_id' => $staticComponent->id
            ]
        );
    }

    /**
     * @test
     */
    public function it_fails_to_update_page_components_no_required_fields(): void
    {
        // arrange
        $pages = $this->seedPages();
        $page = $pages->first();
        $data = ['components' => [['id' => 100]]];

        // act
        $response = $this->put(route('components.update', $page->id), $data);

        // assert
        $response->assertSessionHasErrors(['components.0.id']);
    }

    /**
     * @test
     */
    public function it_can_not_update_page_components_if_user_is_not_logged_in(): void
    {
        // arrange
        $this->logoutUser();

        // act
        $response = $this->put(route('components.update', 1));

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
        $this->get(route('components.create'));
    }

    /**
     * @test
     */
    public function it_can_not_delete_page_route_no_exists(): void
    {
        // act
        $this->expectException(RouteNotFoundException::class);
        $this->get(route('components.destroy'));
    }

    /**
     * It create page items
     *
     * @param int $count
     * @return Collection
     */
    private function seedPages(int $count = 1): Collection
    {
        return Page::factory()
            ->count($count)
            ->has(StaticComponent::factory())
            ->has(StaticComponent::factory()->type('news'))
            ->has(StaticComponent::factory()->type('slider'))
            ->has(StaticComponent::factory()->type('product'))
            ->has(StaticComponent::factory()->type('activity'))
            ->create();
    }

    /**
     * It creates media
     *
     * @param int $count
     * @return Collection
     */
    private function seedMedia(int $count = 2): Collection
    {
        return Media::factory()->count($count)->create();
    }
}
