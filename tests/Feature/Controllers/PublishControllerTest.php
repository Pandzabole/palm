<?php

namespace Feature\Controllers;

use App\Models\Publish;
use Illuminate\Support\Facades\Http;
use Tests\ContentTestCase;

class PublishControllerTest extends ContentTestCase
{
    /**
     * @param string|null $name
     * @param array $data
     * @param int|string $dataName
     *
     * @internal This method is not covered by the backward compatibility promise for PHPUnit
     */
    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->withPublish = false;
    }

    /**
     * @test
     */
    public function it_publishes_content(): void
    {
        // arrange
        Publish::factory()->create();
        Http::fake(['*' => Http::response('Success', 201)]);

        // act
        $response = $this->json('get', route('publish'));

        // assert
        $response->assertSuccessful();
        $this->assertDatabaseHas('publishes', ['status' => 1]);
    }

    /**
     * @test
     */
    public function it_publishes_unpublished(): void
    {
        // arrange
        Publish::factory()->create(['status' => 0]);

        Http::fake(['*' => Http::response('Success', 201)]);

        // act
        $response = $this->json('get', route('publish'));

        // assert
        $response->assertSuccessful();
        $this->assertDatabaseHas('publishes', ['status' => 1]);
    }

    /**
     * @test
     */
    public function it_fails_to_publish(): void
    {
        // arrange
        $statusCode = 505;
        Publish::factory()->create(['status' => 0]);
        Http::fake(['*' => Http::response('Error', $statusCode)]);

        // act
        $response = $this->json('get', route('publish'));

        // assert
        $this->assertDatabaseMissing('publishes', ['status' => 1]);
        $response->assertStatus($statusCode);
    }
}
