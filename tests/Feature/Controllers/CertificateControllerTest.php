<?php

namespace Feature\Controllers;

use App\Models\Certificate;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\ContentTestCase;
use Tests\TestHelpers\MediaAssert;

class CertificateControllerTest extends ContentTestCase
{
    use MediaAssert;

    /**
     * @test
     */
    public function it_shows_certificates_view_on_index(): void
    {
        // act
        $response = $this->get(route('certificates.index'));

        // assert
        $response->assertSuccessful();
        $response->assertViewIs('admin.certificates.index');
    }

    /**
     * @test
     */
    public function it_shows_certificates_data_on_index(): void
    {
        // arrange
        $certificates = $this->setCertificates(2);

        // act
        $response = $this->json('get', route('certificates.data'));
        $data = $response->getData()->data;

        // assert
        $response->assertSuccessful();
        foreach ($certificates as $key => $certificate) {
            self::assertEquals($certificate->name, $data[$key]->name);
        }
    }

    /**
     * @test
     */
    public function it_fails_to_show_certificates_on_index_no_authorization(): void
    {
        // arrange
        $this->logoutUser();

        // act
        $response = $this->get(route('certificates.index'));

        // assert
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function it_shows_certificate_on_show_page(): void
    {
        // arrange
        $certificates = $this->setCertificates();
        $certificate = $certificates->first();

        // act
        $response = $this->get(route('certificates.show', $certificate->id));
        $data = $response->viewData('certificate');

        // assert
        $response->assertSuccessful();
        $response->assertViewIs('admin.certificates.show');
        $response->assertViewHas('certificate');
        self::assertEquals($certificate->name, $data->name);
        self::assertEquals($certificate->firstMediaUrl(), $data->firstMediaUrl());
    }

    /**
     * @test
     */
    public function it_fails_to_show_certificate_on_show_page_no_authorization(): void
    {
        // arrange
        $this->logoutUser();

        // act
        $response = $this->get(route('certificates.show', 1));

        // assert
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function it_shows_certificate_on_edit_page(): void
    {
        // arrange
        $certificates = $this->setCertificates(2);
        $certificate = $certificates->first();

        // act
        $response = $this->get(route('certificates.edit', $certificate->id));
        $data = $response->viewData('certificate');

        // assert
        $response->assertSuccessful();
        $response->assertViewIs('admin.certificates.edit');
        $response->assertViewHas('certificate');
        self::assertEquals($certificate->name, $data->name);
        self::assertEquals($certificate->firstMediaUrl(), $data->firstMediaUrl());
    }

    /**
     * @test
     */
    public function it_fails_to_show_edit_page_no_authorization(): void
    {
        // arrange
        $this->logoutUser();

        // act
        $response = $this->get(route('certificates.edit', 1));

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
        $response = $this->get(route('certificates.create'));

        // assert
        $response->assertSuccessful();
        $response->assertViewIs('admin.certificates.create');
    }

    /**
     * @test
     */
    public function it_fails_to_show_create_page_no_authorization(): void
    {
        // arrange
        $this->logoutUser();

        // act
        $response = $this->get(route('certificates.create'));

        // assert
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function it_creates_certificate_with_image(): void
    {
        // arrange
        Storage::fake('public');

        $data = [
            'name' => 'name',
            'image' => UploadedFile::fake()->image('photo1.jpg'),
        ];
        $expectedData = [
            'name' => 'name'
        ];

        // act
        $response = $this->post(route('certificates.store'), $data);

        // assert
        $response->assertRedirect(route('certificates.show', 1));
        $this->assertMediaExists(Certificate::first()->firstMedia());
        $this->assertDatabaseHas('certificates', $expectedData);
    }

    /**
     * @test
     */
    public function it_creates_certificate_with_existing_image(): void
    {
        // arrange
        $certificates = $this->setCertificates();
        $certificate = $certificates->first();
        $media = $certificate->first()->firstMedia();
        $data = [
            'name' => 'name',
            'media_id' => 1
        ];
        $expectedData = [
            'name' => 'name'
        ];
        $expectedMediaData = [
            'media_id' => $media->id,
            'mediable_type' => Certificate::class,
            'mediable_id' => 1
        ];

        // act
        $response = $this->post(route('certificates.store'), $data);

        // assert
        $response->assertRedirect(route('certificates.show', 2));
        $this->assertDatabaseHas('certificates', $expectedData);
        $this->assertDatabaseHas('mediables', $expectedMediaData);
    }

    /**
     * @test
     */
    public function it_fails_to_create_certificate_no_required_fields(): void
    {
        // arrange
        $data = [];

        // act
        $response = $this->post(route('certificates.store'), $data);

        // assert
        $response->assertSessionHasErrors(['name']);
    }

    /**
     * @test
     */
    public function it_fails_to_create_certificate_no_authorization(): void
    {
        // arrange
        $this->logoutUser();

        // act
        $response = $this->post(route('certificates.store'), []);

        // assert
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function it_updates_certificate(): void
    {
        // arrange
        $certificates = $this->setCertificates();
        $certificate = $certificates->first();
        $data = [
            'name' => 'name'
        ];
        $expectedData = [
            'id' => $certificate->id,
            'name' => $data['name']
        ];

        // act
        $response = $this->put(route('certificates.update', $certificate->id), $data);

        // assert
        $response->assertRedirect(route('certificates.show', $certificate->id));
        $this->assertDatabaseHas('certificates', $expectedData);
    }

    /**
     * @test
     */
    public function it_updates_certificate_with_image(): void
    {
        // arrange
        $certificates = $this->setCertificates();
        $certificate = $certificates->first();
        $data = [
            'name' => 'name',
            'image' => UploadedFile::fake()->image('photo1.jpg'),

        ];
        $expectedData = [
            'id' => $certificate->id,
            'name' => $data['name']
        ];
        $expectedMediaData = [
            'media_id' => 2,
            'mediable_type' => Certificate::class,
            'mediable_id' => $certificate->id
        ];

        // act
        $response = $this->put(route('certificates.update', $certificate->id), $data);

        // assert
        $response->assertRedirect(route('certificates.show', $certificate->id));
        $this->assertDatabaseHas('certificates', $expectedData);
        $this->assertDatabaseHas('mediables', $expectedMediaData);
        $this->assertMediaExists($certificate->load('media')->firstMedia());
    }

    /**
     * @test
     */
    public function it_updates_certificate_with_existing_image(): void
    {
        // arrange
        $certificates = $this->setCertificates(2);
        $certificate = $certificates->first();
        $media = $certificate->find(1)->firstMedia();
        $data = [
            'name' => 'name',
            'media_id' => $media->id,
        ];
        $expectedData = [
            'id' => $certificate->id,
            'name' => $data['name'],
        ];
        $expectedMediaData = [
            'media_id' => $media->id,
            'mediable_type' => Certificate::class,
            'mediable_id' => $certificate->id
        ];

        // act
        $response = $this->put(route('certificates.update', $certificate->id), $data);

        // assert
        $response->assertRedirect(route('certificates.show', $certificate->id));
        $this->assertDatabaseHas('certificates', $expectedData);
        $this->assertDatabaseHas('mediables', $expectedMediaData);
    }

    /**
     * @test
     */
    public function it_fails_to_update_certificate_no_required_fields(): void
    {
        // arrange
        $certificates = $this->setCertificates();
        $certificate = $certificates->first();
        $data = [];

        // act
        $response = $this->put(route('certificates.update', $certificate->id), $data);

        // assert
        $response->assertSessionHasErrors(['name']);
    }

    /**
     * @test
     */
    public function it_fails_to_update_certificate_if_image_deleted(): void
    {
        // arrange
        $certificates = $this->setCertificates();
        $certificate = $certificates->first();
        $data = [
            'name' => 'name',
            'deleted' => true,
        ];

        // act
        $response = $this->put(route('certificates.update', $certificate->id), $data);

        // assert
        $response->assertSessionHasErrors(['image']);
    }

    /**
     * @test
     */
    public function it_fails_to_update_certificates_no_authorization(): void
    {
        // arrange
        $this->logoutUser();

        // act
        $response = $this->put(route('certificates.update', 1), []);

        // assert
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function it_deletes_certificates(): void
    {
        // arrange
        $certificates = $this->setCertificates();
        $certificate = $certificates->first();

        // act
        $response = $this->delete(route('certificates.destroy', $certificate->id));

        // assert
        $this->assertDatabaseMissing('certificates', ['id' => $certificate->id]);
        $response->assertRedirect(route('certificates.index'));
    }

    /**
     * @test
     */
    public function it_fails_to_delete_certificate_no_authorization(): void
    {
        // arrange
        $this->logoutUser();

        // act
        $response = $this->delete(route('certificates.destroy', 1));

        // assert
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * @param int $count
     * @return Collection
     */
    private function setCertificates($count = 1): Collection
    {
        return Certificate::factory()->count($count)->hasMedia()->create();
    }
}
