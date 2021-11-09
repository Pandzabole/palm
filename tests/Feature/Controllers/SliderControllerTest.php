<?php

namespace Feature\Controllers;

use App\Models\Media;
use App\Models\Slider;
use App\Models\SliderItem;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\ContentTestCase;
use Illuminate\Support\Collection;
use Tests\TestHelpers\MediaAssert;

class SliderControllerTest extends ContentTestCase
{
    use MediaAssert;

    /**
     * @test
     */
    public function it_displays_slider_data_on_index_page(): void
    {
        // arrange
        $sliders = $this->seedSliders();
        $slider = $sliders->first();

        // act
        $response = $this->get(route('sliders.index'));
        $data = $response->viewData('slider');

        // assert
        $response->assertSuccessful();
        $response->assertViewIs('admin.sliders.show');

        self::assertEquals($slider->cta_type, $data->cta_type);
        self::assertEquals($slider->steps->toArray(), $data->steps->toArray());
    }

    /**
     * @test
     */
    public function it_shows_sliders_data_on_index(): void
    {
        // arrange
        $sliders = $this->seedSliders(3);
        // act
        $response = $this->json('get', route('sliders.data'));
        $data = $response->getData()->data;

        // assert
        $response->assertSuccessful();
        foreach ($sliders as $key => $slider) {
            self::assertEquals($slider->cta_type, $data[$key]->cta_type);
            foreach ($slider->steps as $stepKey => $sliderItem) {
                self::assertEquals($sliderItem->cta, data_get($data, "$key.steps.$stepKey")->cta);
                self::assertEquals($sliderItem->cta_type, data_get($data, "$key.steps.$stepKey")->cta_type);
                self::assertEquals($sliderItem->position, data_get($data, "$key.steps.$stepKey")->position);
                self::assertEquals($sliderItem->slider_id, data_get($data, "$key.steps.$stepKey")->slider_id);
            }
        }
    }

    /**
     * @test
     */
    public function it_can_not_display_sliders_on_index_page_if_user_is_not_logged_in(): void
    {
        // arrange
        $this->logoutUser();

        // act
        $response = $this->get(route('sliders.index'));

        // assert
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function it_displays_slider_create_page(): void
    {
        // act
        $response = $this->get(route('sliders.create'));

        // assert
        $response->assertSuccessful();
        $response->assertViewIs('admin.sliders.create');
    }

    /**
     * @test
     */
    public function it_fails_to_display_slider_create_page_no_authorization(): void
    {
        // arrange
        $this->logoutUser();

        // act
        $response = $this->get(route('sliders.create'));

        // assert
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function it_creates_slider(): void
    {
        // arrange
        Storage::fake('public');
        $data = [
            'steps' => [
                1 => [
                    'step_id' => 1,
                    'cta' => 'cta-1',
                    'url' => 'url-1',
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
        $response = $this->post(route('sliders.store'), $data);

        // assert
        $response->assertSuccessful();
        foreach ($data['steps'] as $dataStep) {
            $this->assertDatabaseHas(
                'slider_items',
                [
                    'slider_id' => 1,
                    'cta' => $dataStep['cta'],
                    'url' => $dataStep['url'],
                ]
            );
        }

        $mobileImage = SliderItem::first()->mobileImage();
        $desktopImage = SliderItem::first()->desktopImage();

        $this->assertMediaExists($mobileImage);
        $this->assertMediaExists($desktopImage);

        $this->assertDatabaseHas(
            'mediables',
            ['media_id' => $mobileImage->id, 'mediable_type' => SliderItem::class, 'mediable_id' => 1]
        );
        $this->assertDatabaseHas(
            'mediables',
            ['media_id' => $desktopImage->id, 'mediable_type' => SliderItem::class, 'mediable_id' => 1]
        );
    }

    /**
     * @test
     */
    public function it_creates_slider_with_existing_image(): void
    {
        // arrange
        $media = $this->seedMedia();

        $mobileImage = $media->firstWhere('config', 'mobile');
        $desktopImage = $media->firstWhere('config', 'desktop');

        $data = [
            'steps' => [
                1 => [
                    'step_id' => 1,
                    'cta' => 'cta-1',
                    'url' => 'url-1',
                    'media_desktop_id' => $desktopImage->id,
                    'media_mobile_id' => $mobileImage->id,
                ]
            ]
        ];

        // act
        $response = $this->post(route('sliders.store'), $data);

        // assert
        $response->assertSuccessful();
        foreach ($data['steps'] as $dataStep) {
            $this->assertDatabaseHas(
                'slider_items',
                [
                    'slider_id' => 1,
                    'cta' => $dataStep['cta'],
                    'url' => $dataStep['url'],
                ]
            );
        }

        $this->assertDatabaseHas(
            'mediables',
            ['media_id' => $mobileImage->id, 'mediable_type' => SliderItem::class, 'mediable_id' => 1]
        );
        $this->assertDatabaseHas(
            'mediables',
            ['media_id' => $desktopImage->id, 'mediable_type' => SliderItem::class, 'mediable_id' => 1]
        );
    }

    /**
     * @test
     */
    public function it_fails_to_create_slider_no_required_fields(): void
    {
        // arrange
        $data = [
            'page_ids' => [],
            'steps' => [
                [
                    'cta' => null,
                    'url' => null,
                ]
            ]
        ];

        // act
        $response = $this->post(route('sliders.store'), $data);

        // assert
        $response->assertSessionHasErrors(
            [
                'steps.0',
                'steps.0.image_desktop',
                'steps.0.media_desktop_id',
                'steps.0.image_mobile',
                'steps.0.media_mobile_id'
            ]
        );
    }

    /**
     * @test
     */
    public function it_fails_to_create_slider_no_authorization(): void
    {
        // arrange
        $this->logoutUser();

        // act
        $response = $this->post(route('sliders.store'), []);

        // assert
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function it_displays_slider_data_on_show_page(): void
    {
        // arrange
        $sliders = $this->seedSliders();
        $slider = $sliders->first();

        // act
        $response = $this->get(route('sliders.show', $slider->id));
        $data = $response->viewData('slider');

        // assert
        $response->assertSuccessful();
        $response->assertViewIs('admin.sliders.show');

        self::assertEquals($slider->cta_type, $data->cta_type);
        self::assertEquals($slider->steps->toArray(), $data->steps->toArray());
    }

    /**
     * @test
     */
    public function it_can_not_display_slider_on_show_page_if_user_is_not_logged_in(): void
    {
        // arrange
        $this->logoutUser();

        // act
        $response = $this->get(route('sliders.show', 1));

        // assert
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function it_can_not_display_non_existing_slider_on_show_page(): void
    {
        // act
        $response = $this->get(route('sliders.show', 200));

        // assert
        $response->assertStatus(404);
    }

    /**
     * @test
     */
    public function it_shows_slider_on_edit_page(): void
    {
        // arrange
        $sliders = $this->seedSliders(3);
        $slider = $sliders->first();

        // act
        $response = $this->get(route('sliders.edit', $slider->id));
        $data = $response->viewData('slider');

        // assert
        $response->assertSuccessful();
        $response->assertViewHas('slider');
        $response->assertViewHas('mediaDesktop');
        $response->assertViewHas('mediaMobile');
        $response->assertViewIs('admin.sliders.edit');

        self::assertEquals($slider->id, $data->id);
        self::assertEquals($slider->cta_type, $data->cta_type);

        foreach ($slider->steps as $stepKey => $sliderItem) {
            self::assertEquals($sliderItem->cta, data_get($data, 'steps.' . $stepKey)->cta);
            self::assertEquals($sliderItem->cta_type, data_get($data, 'steps.' . $stepKey)->cta_type);
            self::assertEquals($sliderItem->position, data_get($data, 'steps.' . $stepKey)->position);
            self::assertEquals($sliderItem->slider_id, data_get($data, 'steps.' . $stepKey)->slider_id);
        }
    }

    /**
     * @test
     */
    public function it_can_not_display_slider_on_edit_if_user_is_not_logged_in(): void
    {
        // arrange
        $this->logoutUser();

        // act
        $response = $this->get(route('sliders.edit', 1));

        // assert
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function it_updates_slider(): void
    {
        // arrange
        Storage::fake('public');
        $sliders = $this->seedSliders();
        $slider = $sliders->first();
        $data = [
            'steps' => [
                1 => [
                    'cta' => 'cta-1',
                    'url' => 'url-1',
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
        $this->put(route('sliders.update', $slider->id), $data);

        // assert
        foreach ($data['steps'] as $dataStep) {
            $this->assertDatabaseHas(
                'slider_items',
                [
                    'slider_id' => $slider->id,
                    'cta' => $dataStep['cta'],
                    'url' => $dataStep['url'],
                ]
            );
        }

        $sliderItem = $slider->steps->last();
        $mobileImage = $sliderItem->mobileImage();
        $desktopImage = $sliderItem->desktopImage();

        $this->assertMediaExists($mobileImage);
        $this->assertMediaExists($desktopImage);

        $this->assertDatabaseHas(
            'mediables',
            ['media_id' => $mobileImage->id, 'mediable_type' => SliderItem::class, 'mediable_id' => $sliderItem->id]
        );
        $this->assertDatabaseHas(
            'mediables',
            ['media_id' => $desktopImage->id, 'mediable_type' => SliderItem::class, 'mediable_id' => $sliderItem->id]
        );
    }

    /**
     * @test
     */
    public function it_updates_slider_with_deleted_step(): void
    {
        // arrange
        Storage::fake('public');
        $sliders = $this->seedSliders();
        $slider = $sliders->first();
        $step1 = $slider->steps->first();
        $step2 = $slider->steps->last();
        $data = [
            'steps' => [],
            'deleted_steps' => [2]
        ];

        // act
        $this->put(route('sliders.update', $slider->id), $data);

        // assert
        $this->assertDatabaseHas(
            'slider_items',
            [
                'slider_id' => $slider->id,
                'cta' => $step1->cta,
                'url' => $step1->url,
            ]
        );
        $this->assertDatabaseMissing(
            'slider_items',
            [
                'slider_id' => $slider->id,
                'cta' => $step2->cta,
                'url' => $step2->url,
            ]
        );
    }

    /**
     * @test
     */
    public function it_fails_to_update_slider_if_step_image_deleted(): void
    {
        // arrange
        $this->seedSliders();
        $data = [
            'steps' => [
                [
                    'mobile_deleted' => true
                ]
            ]
        ];

        // act
        $response = $this->put(route('sliders.update', 1), $data);

        // assert
        $response->assertSessionHasErrors(['steps.0']);
    }

    /**
     * @test
     */
    public function it_fails_to_update_slider_no_authorisation(): void
    {
        // arrange
        $this->logoutUser();

        // act
        $response = $this->get(route('sliders.update', 1));

        // assert
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function it_deletes_slider(): void
    {
        // arrange
        $sliders = $this->seedSliders();
        $slider = $sliders->first();

        // act
        $response = $this->delete(route('sliders.destroy', $slider));

        // assert
        $this->assertDatabaseMissing('sliders', ['id' => $slider->id]);
        $response->assertRedirect(route('sliders.index'));
    }

    /**
     * @test
     */
    public function it_fails_to_delete_slider_no_authorization(): void
    {
        // arrange
        $this->logoutUser();
        $sliders = $this->seedSliders();
        $slider = $sliders->first();

        // act
        $response = $this->delete(route('sliders.destroy', $slider->id));

        // assert
        $this->assertDatabaseHas('sliders', ['id' => $slider->id]);
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * It creates slider items
     *
     * @param int $count
     * @return Collection
     */
    private function seedSliders(int $count = 1): Collection
    {
        return Slider::factory()->hasSteps(2)->count($count)->create();
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
