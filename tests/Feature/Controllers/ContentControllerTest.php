<?php

namespace Feature\Controllers;

use App\Models\Content\ImageContent;
use App\Models\Content\RichTextContent;
use App\Models\Content\TextContent;
use App\Models\Content\VideoContent;
use App\Models\Media;
use App\Models\News;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Tests\ContentTestCase;
use Tests\TestHelpers\MediaAssert;

class ContentControllerTest extends ContentTestCase
{
    use MediaAssert;

    /** @var Collection $contents */
    private $contents;

    /** @var Collection $textContents */
    private $textContents;

    /** @var Collection $richTextContents */
    private $richTextContents;

    /** @var Collection $imagContents */
    private $imageContents;

    /** @var Collection $videoContents */
    private $videoContents;

    /** @var Collection $resource */
    private $resource;

    /**
     * @test
     */
    public function it_shows_contents_data_on_resource_index(): void
    {
        // arrange
        $this->setContents();

        // act
        $response = $this->json('get', route('contents.data', ['containable' => News::class, 'containable_id' => 1]));
        $data = $response->getData()->data;

        // assert
        $response->assertSuccessful();
        foreach ($this->contents->toArray() as $key => $content) {
            self::assertEquals(data_get($content, 'name'), data_get($data[$key], 'name'));
            self::assertEquals(data_get($content, 'content_type'), data_get($data[$key], 'content_type'));
            self::assertEquals(data_get($content, 'alt'), data_get($data[$key], 'alt'));
            self::assertEquals(data_get($content, 'type'), data_get($data[$key], 'type'));
            self::assertEquals(
                htmlentities(data_get($content, 'content')),
                data_get($data[$key], 'content')
            );
        }
    }

    /**
     * @test
     */
    public function it_creates_text_content(): void
    {
        // arrange
        $this->setResource();

        $data = [
            'containable' => News::class,
            'containable_id' => 1,
            'content_type' => TextContent::class,
            'name' => 'Name',
            'type' => 'h2',
            'content' => 'Some text',
        ];

        $expectedContentData = [
            'containable_type' => $data['containable'],
            'containable_id' => $data['containable_id'],
            'contentable_type' => $data['content_type'],
            'contentable_id' => 1
        ];
        $expectedTextContentData = [
            'id' => 1,
            'name' => $data['name'],
            'type' => $data['type'],
            'content' => $data['content'],
        ];

        // act
        $response = $this->post(route('contents.store'), $data);

        // assert
        $response->assertSuccessful();
        $response->assertJson($expectedTextContentData);
        $this->assertDatabaseHas('contents', $expectedContentData);
        $this->assertDatabaseHas('text_content', $expectedTextContentData);
    }

    /**
     * @test
     */
    public function it_creates_rich_text_content(): void
    {
        // arrange
        $this->setResource();

        $data = [
            'containable' => News::class,
            'containable_id' => 1,
            'content_type' => RichTextContent::class,
            'name' => 'Name',
            'content' => '<h1>Text</h1><p>Text</p>',
        ];

        $expectedContentData = [
            'containable_type' => $data['containable'],
            'containable_id' => $data['containable_id'],
            'contentable_type' => $data['content_type'],
            'contentable_id' => 1
        ];
        $expectedRichTextContentData = [
            'id' => 1,
            'name' => $data['name'],
            'content' => $data['content'],
        ];

        // act
        $response = $this->post(route('contents.store'), $data);

        // assert
        $response->assertSuccessful();
        $response->assertJson($expectedRichTextContentData);
        $this->assertDatabaseHas('contents', $expectedContentData);
        $this->assertDatabaseHas('rich_text_content', $expectedRichTextContentData);
    }

    /**
     * @test
     */
    public function it_creates_image_content(): void
    {
        // arrange
        Storage::fake('public');
        $this->setResource();

        $data = [
            'containable' => News::class,
            'containable_id' => 1,
            'content_type' => ImageContent::class,
            'name' => 'Name',
            'alt' => 'Alt text',
            'image' => UploadedFile::fake()->image('photo1.jpg'),
        ];

        $expectedContentData = [
            'containable_type' => $data['containable'],
            'containable_id' => $data['containable_id'],
            'contentable_type' => $data['content_type'],
            'contentable_id' => 1
        ];
        $expectedImageContentData = [
            'id' => 1,
            'name' => $data['name'],
            'alt' => $data['alt'],
        ];
        $expectedMediaData = [
            'media_id' => 1,
            'mediable_type' => ImageContent::class,
            'mediable_id' => 1
        ];

        // act
        $response = $this->post(route('contents.store'), $data);

        // assert
        $response->assertSuccessful();
        $response->assertJson($expectedImageContentData);
        $this->assertDatabaseHas('contents', $expectedContentData);
        $this->assertDatabaseHas('image_content', $expectedImageContentData);
        $this->assertDatabaseHas('mediables', $expectedMediaData);
        $this->assertMediaExists(ImageContent::first()->firstMedia());
    }

    /**
     * @test
     */
    public function it_creates_image_content_with_existing_image(): void
    {
        // arrange
        Storage::fake('public');
        $this->setResource(News::class, true);
        $media = $this->resource->firstMedia();

        $data = [
            'containable' => News::class,
            'containable_id' => 1,
            'content_type' => ImageContent::class,
            'name' => 'Name',
            'alt' => 'Alt text',
            'media_id' => $media->id,
        ];

        $expectedContentData = [
            'containable_type' => $data['containable'],
            'containable_id' => $data['containable_id'],
            'contentable_type' => $data['content_type'],
            'contentable_id' => 1
        ];
        $expectedImageContentData = [
            'id' => 1,
            'name' => $data['name'],
            'alt' => $data['alt'],
        ];
        $expectedMediaData = [
            'media_id' => $media->id,
            'mediable_type' => ImageContent::class,
            'mediable_id' => 1
        ];

        // act
        $response = $this->post(route('contents.store'), $data);

        // assert
        $response->assertSuccessful();
        $response->assertJson($expectedImageContentData);
        $this->assertDatabaseHas('contents', $expectedContentData);
        $this->assertDatabaseHas('image_content', $expectedImageContentData);
        $this->assertDatabaseHas('mediables', $expectedMediaData);
    }

    /**
     * @test
     */
    public function it_creates_video_content(): void
    {
        // arrange
        Storage::fake('public');
        $this->setResource();

        $data = [
            'containable' => News::class,
            'containable_id' => 1,
            'content_type' => VideoContent::class,
            'name' => 'Name',
            'video' => new UploadedFile(config('seeder.video_url'), 'name', 'video/mp4', 0, true)
        ];

        $expectedContentData = [
            'containable_type' => $data['containable'],
            'containable_id' => $data['containable_id'],
            'contentable_type' => $data['content_type'],
            'contentable_id' => 1
        ];
        $expectedVideoContentData = [
            'id' => 1,
            'name' => $data['name'],
        ];
        $expectedMediaData = [
            'media_id' => 1,
            'mediable_type' => VideoContent::class,
            'mediable_id' => 1
        ];

        // act
        $response = $this->post(route('contents.store'), $data);

        // assert
        $response->assertSuccessful();
        $response->assertJson($expectedVideoContentData);
        $this->assertDatabaseHas('contents', $expectedContentData);
        $this->assertDatabaseHas('video_content', $expectedVideoContentData);
        $this->assertDatabaseHas('mediables', $expectedMediaData);
        $this->assertMediaExists(VideoContent::first()->firstMedia(), false);
    }

    /**
     * @test
     */
    public function it_fails_to_create_content_no_required_fields(): void
    {
        // arrange
        $data = [
            'name' => '',
            'containable' => '',
            'containable_id' => '',
            'content_type' => ''
        ];

        // act
        $response = $this->post(route('contents.store'), $data);

        // assert
        $response->assertSessionHasErrors(['name', 'containable', 'containable_id', 'content_type']);
    }

    /**
     * @test
     */
    public function it_fails_to_create_rich_text_content_no_required_fields(): void
    {
        // arrange
        $this->setResource();
        $data = [
            'content_type' => RichTextContent::class,
            'containable' => News::class,
            'containable_id' => 1,
            'name' => '',
            'content' => '',
        ];

        // act
        $response = $this->post(route('contents.store'), $data);

        // assert
        $response->assertSessionHasErrors(['name', 'content']);
    }

    /**
     * @test
     */
    public function it_fails_to_create_text_content_no_required_fields(): void
    {
        // arrange
        $this->setResource();
        $data = [
            'content_type' => TextContent::class,
            'containable' => News::class,
            'containable_id' => 1,
            'name' => '',
            'type' => '',
            'content' => '',
        ];

        // act
        $response = $this->post(route('contents.store'), $data);

        // assert
        $response->assertSessionHasErrors(['name', 'type', 'content']);
    }

    /**
     * @test
     */
    public function it_fails_to_create_image_content_no_required_fields(): void
    {
        // arrange
        $this->setResource();
        $data = [
            'content_type' => ImageContent::class,
            'containable' => News::class,
            'containable_id' => 1,
            'image' => '',
            'media_id' => ''
        ];

        // act
        $response = $this->post(route('contents.store'), $data);

        // assert
        $response->assertSessionHasErrors(['image', 'media_id']);
    }

    /**
     * @test
     */
    public function it_fails_to_create_video_content_no_required_fields(): void
    {
        // arrange
        $this->setResource();
        $data = [
            'content_type' => VideoContent::class,
            'containable' => News::class,
            'containable_id' => 1,
            'video' => '',
            'media_id' => ''
        ];

        // act
        $response = $this->post(route('contents.store'), $data);

        // assert
        $response->assertSessionHasErrors(['video', 'media_id']);
    }

    /**
     * @test
     */
    public function it_fails_to_create_content_no_authorization(): void
    {
        // arrange
        $this->logoutUser();

        // act
        $response = $this->post(route('contents.store'), []);

        // assert
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function it_updates_text_content(): void
    {
        // arrange
        $this->setContents();
        $textContent = $this->textContents->first();

        $data = [
            'content_type_class' => TextContent::class,
            'name' => 'Name',
            'type' => 'h2',
            'content' => 'Some text',
        ];
        $expectedTextContentData = [
            'id' => $textContent->id,
            'name' => $data['name'],
            'type' => $data['type'],
            'content' => $data['content'],
        ];

        // act
        $response = $this->put(route('contents.update', $textContent->id), $data);

        // assert
        $response->assertSuccessful();
        $response->assertJson($expectedTextContentData);
        $this->assertDatabaseHas('text_content', $expectedTextContentData);
    }

    /**
     * @test
     */
    public function it_updates_rich_text_content(): void
    {
        // arrange
        $this->setContents();
        $richTextContent = $this->richTextContents->first();

        $data = [
            'content_type_class' => RichTextContent::class,
            'name' => 'Name',
            'content' => '<h1>Text</h1><p>Text</p>',
        ];
        $expectedRichTextContentData = [
            'id' => $richTextContent->id,
            'name' => $data['name'],
            'content' => $data['content'],
        ];

        // act
        $response = $this->put(route('contents.update', $richTextContent->id), $data);

        // assert
        $response->assertSuccessful();
        $response->assertJson($expectedRichTextContentData);
        $this->assertDatabaseHas('rich_text_content', $expectedRichTextContentData);
    }

    /**
     * @test
     */
    public function it_updates_image_content(): void
    {
        // arrange
        Storage::fake('public');
        $this->setContents();
        $imageContent = $this->imageContents->first();

        $data = [
            'content_type_class' => ImageContent::class,
            'name' => 'Name',
            'alt' => 'Alt text',
            'image' => UploadedFile::fake()->image('photo1.jpg'),
        ];
        $expectedImageContentData = [
            'id' => $imageContent->id,
            'name' => $data['name'],
            'alt' => $data['alt'],
        ];
        $expectedMediaData = [
            'media_id' => 1,
            'mediable_type' => ImageContent::class,
            'mediable_id' => 1
        ];

        // act
        $response = $this->put(route('contents.update', $imageContent->id), $data);

        // assert
        $response->assertSuccessful();
        $response->assertJson($expectedImageContentData);
        $this->assertDatabaseHas('image_content', $expectedImageContentData);
        $this->assertDatabaseHas('mediables', $expectedMediaData);
        $this->assertMediaExists(ImageContent::first()->firstMedia());
    }

    /**
     * @test
     */
    public function it_updates_image_content_with_existing_image(): void
    {
        // arrange
        Storage::fake('public');
        $this->setContents(News::class, true);
        $imageContent = $this->imageContents->first();
        $media = $this->resource->firstMedia();

        $data = [
            'content_type_class' => ImageContent::class,
            'name' => 'Name',
            'alt' => 'Alt text',
            'media_id' => $media->id,
        ];
        $expectedImageContentData = [
            'id' => $imageContent->id,
            'name' => $data['name'],
            'alt' => $data['alt'],
        ];
        $expectedMediaData = [
            'media_id' => $media->id,
            'mediable_type' => ImageContent::class,
            'mediable_id' => 1
        ];

        // act
        $response = $this->put(route('contents.update', $imageContent->id), $data);

        // assert
        $response->assertSuccessful();
        $response->assertJson($expectedImageContentData);
        $this->assertDatabaseHas('image_content', $expectedImageContentData);
        $this->assertDatabaseHas('mediables', $expectedMediaData);
    }

    /**
     * @test
     */
    public function it_updates_video_content(): void
    {
        // arrange
        Storage::fake('public');
        $this->setContents();
        $videoContent = $this->videoContents->first();

        $data = [
            'content_type_class' => VideoContent::class,
            'name' => 'Name',
            'video' => new UploadedFile(config('seeder.video_url'), 'name', 'video/mp4', 0, true),
        ];
        $expectedVideoContentData = [
            'id' => $videoContent->id,
            'name' => $data['name'],
        ];
        $expectedMediaData = [
            'media_id' => 1,
            'mediable_type' => VideoContent::class,
            'mediable_id' => 1
        ];

        // act
        $response = $this->put(route('contents.update', $videoContent->id), $data);

        // assert
        $response->assertSuccessful();
        $response->assertJson($expectedVideoContentData);
        $this->assertDatabaseHas('video_content', $expectedVideoContentData);
        $this->assertDatabaseHas('mediables', $expectedMediaData);
        $this->assertMediaExists(VideoContent::first()->firstMedia(), false);
    }

    /**
     * @test
     */
    public function it_fails_to_update_content_no_required_fields(): void
    {
        $this->setContents();
        $textContent = $this->textContents->first();

        // arrange
        $data = [
            'name' => '',
            'content_type_class' => ''
        ];

        // act
        $response = $this->put(route('contents.update', $textContent->id), $data);

        // assert
        $response->assertSessionHasErrors(['name', 'content_type_class']);
    }

    /**
     * @test
     */
    public function it_fails_to_update_content_no_authorization(): void
    {
        // arrange
        $this->logoutUser();

        // act
        $response = $this->put(route('contents.update', 1), []);

        // assert
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }


    /**
     * @test
     */
    public function it_reorders_content(): void
    {
        // arrange
        $this->setContents();
        $data = [
            'items' => [['new' => 1, 'old' => 2], ['new' => 2, 'old' => 1]],
            'containable' => News::class,
            'containable_id' => 1,
        ];
        $expectedData = [
            ['id' => 1, 'sort_order' => 2],
            ['id' => 2, 'sort_order' => 1]
        ];

        // arrange
        $this->post(route('contents.reorder'), $data);

        // assert
        $this->assertDatabaseHas('contents', $expectedData[0]);
        $this->assertDatabaseHas('contents', $expectedData[1]);
    }

    /**
     * @test
     */
    public function it_fails_to_reorder_contents_no_required_sort_order(): void
    {
        // arrange
        $this->setContents();
        $data = ['items' => [['new' => 99, 'old' => 98], ['new' => 97, 'old' => 98]]];

        // arrange
        $response = $this->post(route('contents.reorder'), $data);

        // assert
        $response->assertSessionHasErrors(
            ['containable', 'containable_id', 'items.0.new', 'items.1.new', 'items.0.old', 'items.1.old']
        );
    }

    /**
     * @test
     */
    public function it_deletes_content(): void
    {
        // arrange
        $this->setContents();

        $data = [
            'content_id' => 1,
            'content_type' => TextContent::class,
        ];

        // act
        $response = $this->post(
            route('contents.destroy', ['containable' => News::class, 'containable_id' => 1]),
            $data
        );

        // assert
        $this->assertDatabaseMissing('contents', ['contentable_type' => TextContent::class, 'contentable_id' => 1]);
        $response->assertSuccessful();
    }

    /**
     * @test
     */
    public function it_fails_to_delete_content_no_required_fields(): void
    {
        // arrange
        $data = [
            'content_id' => '',
            'content_type' => '',
            'containable' => '',
            'containable_id' => '',
        ];

        // act
        $response = $this->post(route('contents.destroy'), $data);

        // assert
        $response->assertSessionHasErrors(['content_id', 'content_type', 'containable', 'containable_id']);
    }

    /**
     * @test
     */
    public function it_fails_to_delete_content_no_authorization(): void
    {
        // arrange
        $this->logoutUser();
        $this->setContents();

        // act
        $response = $this->post(route('contents.destroy', []));

        // assert
        $this->assertDatabaseHas('contents', ['contentable_type' => TextContent::class, 'contentable_id' => 1]);
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    private function setResource($resourceClass = News::class, $media = false): void
    {
        $this->resource = $resourceClass::factory()->create();

        if ($media) {
            $this->resource->media()->save(Media::factory()->make());
        }
    }

    private function setContents($resourceClass = News::class, $media = false): void
    {
        $toInsert = [];
        $this->contents = collect();

        $this->setResource($resourceClass, $media);

        $this->textContents = TextContent::factory()
            ->count(3)
            ->create()
            ->each(function ($textContent) {
                $this->contents->push($textContent);
            });
        $this->richTextContents = RichTextContent::factory()
            ->count(3)
            ->create()
            ->each(function ($markdownContent) {
                $this->contents->push($markdownContent);
            });
        $this->imageContents = ImageContent::factory()
            ->count(3)
            ->create()
            ->each(function ($imageContent) {
                $this->contents->push($imageContent);
            });
        $this->videoContents = VideoContent::factory()
            ->count(3)
            ->create()
            ->each(function ($videoContent) {
                $this->contents->push($videoContent);
            });

        $this->contents->each(static function ($content, $key) use (&$toInsert) {
            $toInsert[] = [
                'containable_type' => News::class,
                'containable_id' => 1,
                'contentable_type' => get_class($content),
                'contentable_id' => $content->id,
                'sort_order' => $key + 1
            ];
        });

        DB::table('contents')->insert($toInsert);
    }
}
