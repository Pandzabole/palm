<?php

namespace Tests\Feature\Controllers;

use App\Models\Media;
use App\Models\MetaData;
use App\Models\Page;
use Illuminate\Database\Eloquent\Collection;
use Database\Factories\MetaDataFactory;
use Illuminate\Http\UploadedFile;
use Tests\ContentTestCase;
use Tests\TestHelpers\MediaAssert;

class MetaDataControllerTest extends ContentTestCase
{
    use MediaAssert;

    /** @var Collection $metaData */
    private $metaData;

    /** @var Collection $pages */
    private $pages;

    /**
     * @test
     */
    public function it_shows_meta_data_view_on_index(): void
    {
        // act
        $response = $this->get(route('meta-data.index'));

        // assert
        $response->assertSuccessful();
        $response->assertViewIs('admin.meta-data.index');
    }

    /**
     * @test
     */
    public function it_shows_meta_data_on_index(): void
    {
        // arrange
        $this->setMetaData(2, false);

        // act
        $response = $this->json('get', route('meta.data'));
        $data = $response->getData()->data;

        // assert
        $response->assertSuccessful();
        foreach ($this->metaData as $key => $meta) {
            self::assertEquals($meta->title, $data[$key]->title);
            self::assertEquals($meta->page->name, $data[$key]->page->name);
        }
    }

    /**
     * @test
     */
    public function it_fails_to_show_meta_data_on_index_no_authorization(): void
    {
        // arrange
        $this->logoutUser();

        // act
        $response = $this->get(route('meta-data.index'));

        // assert
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function it_shows_meta_data_on_show_page(): void
    {
        // arrange
        $this->setMetaData();
        $metaData = $this->metaData->first();

        // act
        $response = $this->get(route('meta-data.show', $metaData->id));
        $data = $response->viewData('metaData');

        // assert
        $response->assertSuccessful();
        $response->assertViewIs('admin.meta-data.show');
        self::assertEquals($metaData->title, $data->title);
        self::assertEquals($metaData->keywords, $data->keywords);
        self::assertEquals($metaData->description, $data->description);
        self::assertEquals($metaData->firstMediaUrl(), $data->firstMediaUrl());
    }

    /**
     * @test
     */
    public function it_fails_to_show_meta_data_on_show_page_no_authorization(): void
    {
        // arrange
        $this->logoutUser();

        // act
        $response = $this->get(route('meta-data.show', 1));

        // assert
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function it_shows_meta_data_on_edit_page(): void
    {
        // arrange
        $this->setMetaData(2);
        $metaData = $this->metaData->first();

        // act
        $response = $this->get(route('meta-data.edit', $metaData->id));
        $response->content();
        $data = $response->viewData('metaData');

        // assert
        $response->assertSuccessful();
        $response->assertViewIs('admin.meta-data.edit');
        $response->assertViewHas('metaData');
        self::assertEquals($metaData->title, $data->title);
        self::assertEquals($metaData->description, $data->description);
        self::assertEquals($metaData->keywords, $data->keywords);
        self::assertEquals($metaData->firstMediaUrl(), $data->firstMediaUrl());
    }

    /**
     * @test
     */
    public function it_update_meta_data(): void
    {
        // arrange
        $this->setMetaData(1, false);
        $metaData = $this->metaData->first();
        $data = [
            'title' => 'Title',
            'keywords' => 'Keywords',
            'description' => 'description',
        ];
        $expectedData = [
            'id' => $metaData->id,
            'title' => $data['title'],
            'keywords' => $data['keywords'],
            'description' => $data['description'],
        ];
        // act
        $response = $this->put(route('meta-data.update', $metaData->id), $data);

        // assert
        $response->assertRedirect(route('meta-data.show', $metaData->id));
        $this->assertDatabaseHas('meta_data', $expectedData);
    }

    /**
     * @test
     */
    public function it_updates_meta_data_with_image(): void
    {
        // arrange
        $this->setMetaData();
        $metaData = $this->metaData->first();
        $data = [
            'title' => 'Title',
            'keywords' => 'Keywords',
            'description' => 'description',
            'image' => UploadedFile::fake()->image('photo1.jpg'),
        ];
        $expectedData = [
            'id' => $metaData->id,
            'title' => $data['title'],
            'keywords' => $data['keywords'],
            'description' => $data['description'],
        ];
        $expectedMediaData = [
            'media_id' => 2,
            'mediable_type' => MetaData::class,
            'mediable_id' => $metaData->id
        ];

        // act
        $response = $this->put(route('meta-data.update', $metaData->id), $data);

        // assert
        $response->assertRedirect(route('meta-data.show', $metaData->id));
        $this->assertDatabaseHas('meta_data', $expectedData);
        $this->assertDatabaseHas('mediables', $expectedMediaData);
        $this->assertMediaExists($metaData->load('media')->firstMedia());
    }

    /**
     * @test
     */
    public function it_updates_meta_data_with_existing_image(): void
    {
        // arrange
        $this->setMetaData(2);
        $metaData = $this->metaData->first();
        $media = $this->metaData->find(2)->firstMedia();
        $data = [
            'title' => 'Title',
            'description' => 'description',
            'keywords' => 'Keywords',
            'media_id' => $media->id,
        ];
        $expectedData = [
            'id' => $metaData->id,
            'title' => $data['title'],
            'keywords' => $data['keywords'],
            'description' => $data['description']
        ];
        $expectedMediaData = [
            'media_id' => $media->id,
            'mediable_type' => MetaData::class,
            'mediable_id' => $metaData->id
        ];

        // act
        $response = $this->put(route('meta-data.update', $metaData->id), $data);

        // assert
        $response->assertRedirect(route('meta-data.show', $metaData->id));
        $this->assertDatabaseHas('meta_data', $expectedData);
        $this->assertDatabaseHas('mediables', $expectedMediaData);
    }

    /**
     * @test
     */
    public function it_fails_to_update_meta_data_no_required_fields(): void
    {
        // arrange
        $this->setMetaData();
        $metaData = $this->metaData->first();
        $data = [];

        // act
        $response = $this->put(route('meta-data.update', $metaData->id), $data);

        // assert
        $response->assertSessionHasErrors(['title', 'keywords', 'description']);
    }

    /**
     * @test
     */
    public function it_fails_to_update_meta_data_if_image_deleted(): void
    {
        // arrange
        $this->setMetaData(1, false);
        $metaData = $this->metaData->first();
        $data = [
            'title' => 'Title',
            'description' => 'description',
            'keywords' => 'Keywords',
            'deleted' => true,
        ];

        // act
        $response = $this->put(route('meta-data.update', $metaData->id), $data);

        // assert
        $response->assertSessionHasErrors(['image']);
    }

    /**
     * @test
     */
    public function it_fails_to_update_meta_data_no_authorization(): void
    {
        // arrange
        $this->logoutUser();

        // act
        $response = $this->put(route('meta-data.update', 1), []);

        // assert
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * @param int $count
     * @param bool $media
     * @return void
     */
    public function setMetaData(int $count = 1, $media = true): void
    {
        Page::factory()->count($count)->create();
        MetaDataFactory::resetPosition();
        $this->metaData = MetaData::factory()->count($count)->create();

        if ($media) {
            $this->metaData->each(
                static function ($metaData) {
                    $metaData->media()->save(Media::factory()->make());
                }
            )->load('media');
        }
    }
}
