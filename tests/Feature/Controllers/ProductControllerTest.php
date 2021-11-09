<?php

namespace Feature\Controllers;

use App\Models\Media;
use App\Models\Product;
use App\Models\PackageNumber;
use App\Models\PackageVolume;
use App\Models\StaticComponent;
use Database\Factories\ProductFactory;
use Illuminate\Support\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\ContentTestCase;
use Tests\TestHelpers\MediaAssert;

class ProductControllerTest extends ContentTestCase
{
    use MediaAssert;

    /** @var Collection $products */
    private $products;

    /**
     * @test
     */
    public function it_shows_products_view_on_index(): void
    {
        // act
        $response = $this->get(route('products.index'));

        // assert
        $response->assertSuccessful();
        $response->assertViewIs('admin.products.index');
    }

    /**
     * @test
     */
    public function it_shows_products_data_on_index(): void
    {
        // arrange
        $products = $this->setProducts(2);

        // act
        $response = $this->json('get', route('products.data'));
        $data = $response->getData()->data;

        // assert
        $response->assertSuccessful();
        foreach ($products as $key => $product) {
            self::assertEquals($product->name, $data[$key]->name);
        }
    }

    /**
     * @test
     */
    public function it_fails_to_show_products_on_index_no_authorization(): void
    {
        // arrange
        $this->logoutUser();

        // act
        $response = $this->get(route('products.index'));

        // assert
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function it_shows_product_on_show_page(): void
    {
        // arrange
        $products = $this->setProducts();
        $product = $products->first();

        // act
        $response = $this->get(route('products.show', $product->id));
        $data = $response->viewData('product');

        // assert
        $response->assertSuccessful();
        $response->assertViewIs('admin.products.show');
        $response->assertViewHas('product');
        self::assertEquals($product->name, $data->name);
        self::assertEquals($product->description, $data->description);
        self::assertEquals($product->packageVolume->value, $data->packageVolume->value);
        self::assertEquals($product->packageNumber->value, $data->packageNumber->value);
        self::assertEquals($product->desktopImage()->getThumbUrl(), $data->desktopImage()->getThumbUrl());
        self::assertEquals($product->mobileImage()->getThumbUrl(), $data->mobileImage()->getThumbUrl());
    }

    /**
     * @test
     */
    public function it_fails_to_show_product_on_show_page_no_authorization(): void
    {
        // arrange
        $this->logoutUser();

        // act
        $response = $this->get(route('products.show', 1));

        // assert
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function it_shows_product_on_edit_page(): void
    {
        // arrange
        $products = $this->setProducts();
        $product = $products->first();

        // act
        $response = $this->get(route('products.edit', $product->id));
        $data = $response->viewData('product');

        // assert
        $response->assertSuccessful();
        $response->assertViewIs('admin.products.edit');
        $response->assertViewHas('product');
        self::assertEquals($product->name, $data->name);
        self::assertEquals($product->description, $data->description);
        self::assertEquals($product->package_number_id, $data->package_number_id);
        self::assertEquals($product->package_volume_id, $data->package_volume_id);
        self::assertEquals($product->packageVolume->value, $data->packageVolume->value);
        self::assertEquals($product->packageNumber->value, $data->packageNumber->value);
        self::assertEquals($product->desktopImage()->getThumbUrl(), $data->desktopImage()->getThumbUrl());
        self::assertEquals($product->mobileImage()->getThumbUrl(), $data->mobileImage()->getThumbUrl());
    }

    /**
     * @test
     */
    public function it_fails_to_show_edit_page_no_authorization(): void
    {
        // arrange
        $this->logoutUser();

        // act
        $response = $this->get(route('products.edit', 1));

        // assert
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function it_shows_create_page(): void
    {
        // arrange
        $packageNumbers = $this->setPackageNumber();
        $packageVolumes = $this->setPackageVolume();

        // act
        $response = $this->get(route('products.create'));
        $dataVolume = $response->viewData('packageVolume');
        $dataNumber = $response->viewData('packageNumber');

        // assert
        $response->assertSuccessful();
        $response->assertViewIs('admin.products.create');
        $response->assertViewHasAll(['packageVolume', 'packageNumber']);
        foreach ($packageNumbers as $key => $number) {
            self::assertEquals($number->value, $dataNumber[$key]->value);
        }
        foreach ($packageVolumes as $key => $value) {
            self::assertEquals($value->value, $dataVolume[$key]->value);
        }
    }

    /**
     * @test
     */
    public function it_fails_to_show_create_page_no_authorization(): void
    {
        // arrange
        $this->logoutUser();

        // act
        $response = $this->get(route('products.create'));

        // assert
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function it_creates_product_with_image(): void
    {
        // arrange
        Storage::fake('public');
        $this->setProductsComponent();
        $packageNumbers = $this->setPackageNumber();
        $packageNumber = $packageNumbers->first()->id;
        $packageVolumes = $this->setPackageVolume();
        $packageVolume = $packageVolumes->first()->id;

        $data = [
            'name' => 'name',
            'description' => 'description',
            'package_number_id' => $packageNumber,
            'package_volume_id' => $packageVolume,
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
        ];
        $expectedData = [
            'name' => 'name',
            'description' => 'description',
        ];

        // act
        $response = $this->post(route('products.store'), $data);

        // assert
        $response->assertRedirect(route('products.show', 1));
        $this->assertMediaExists(Product::first()->mobileImage());
        $this->assertMediaExists(Product::first()->desktopImage());
        $this->assertDatabaseHas('products', $expectedData);
    }

    /**
     * @test
     */
    public function it_creates_product_with_existing_image(): void
    {
        // arrange
        $media = $this->seedMedia();
        $this->setProductsComponent();
        $products = $this->setProducts();
        $product = $products->first();
        $mobileImage = $media->firstWhere('config', 'mobile');
        $desktopImage = $media->firstWhere('config', 'desktop');

        $data = [
            'name' => 'name',
            'description' => 'description',
            'package_number_id' => $product->package_number_id,
            'package_volume_id' => $product->package_volume_id,
            'media_desktop_id' => $desktopImage->id,
            'media_mobile_id' => $mobileImage->id,
        ];
        $expectedData = [
            'name' => 'name',
            'description' => 'description',
            'package_number_id' => $product->package_number_id,
            'package_volume_id' => $product->package_volume_id,
        ];
        $expectedMediaDesktopData = [
            'media_id' => $desktopImage->id,
            'mediable_type' => Product::class,
            'mediable_id' => 2
        ];
        $expectedMediaMobileData = [
            'media_id' => $mobileImage->id,
            'mediable_type' => Product::class,
            'mediable_id' => 2
        ];

        // act
        $response = $this->post(route('products.store'), $data);

        // assert
        $response->assertRedirect(route('products.show', 2));
        $this->assertDatabaseHas('products', $expectedData);
        $this->assertDatabaseHas('mediables', $expectedMediaDesktopData);
        $this->assertDatabaseHas('mediables', $expectedMediaMobileData);
    }

    /**
     * @test
     */
    public function it_fails_to_create_products_no_required_fields(): void
    {
        // arrange
        $data = [];

        // act
        $response = $this->post(route('products.store'), $data);

        // assert
        $response->assertSessionHasErrors(['name', 'description', 'package_number_id', 'package_volume_id']);
    }

    /**
     * @test
     */
    public function it_fails_to_create_products_no_authorization(): void
    {
        // arrange
        $this->logoutUser();

        // act
        $response = $this->post(route('products.store'), []);

        // assert
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function it_updates_product(): void
    {
        // arrange
        $products = $this->setProducts();
        $product = $products->first();
        $data = [
            'name' => 'name',
            'description' => 'description',
            'package_number_id' => $product->package_number_id,
            'package_volume_id' => $product->package_volume_id,
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
        ];
        $expectedData = [
            'id' => $product->id,
            'name' => $data['name'],
            'description' => $data['description'],
            'package_number_id' => $data['package_number_id'],
            'package_volume_id' => $data['package_volume_id'],
        ];
        // act
        $response = $this->put(route('products.update', $product->id), $data);

        // assert
        $response->assertRedirect(route('products.show', $product->id));
        $this->assertDatabaseHas('products', $expectedData);
    }

    /**
     * @test
     */
    public function it_updates_product_with_image(): void
    {
        // arrange
        $products = $this->setProducts();
        $product = $products->first();
        Storage::fake('public');

        $data = [
            'name' => 'name',
            'description' => 'description',
            'package_number_id' => $product->package_number_id,
            'package_volume_id' => $product->package_volume_id,
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

        ];
        $expectedData = [
            'id' => $product->id,
            'name' => $data['name'],
            'description' => $data['description'],
            'package_number_id' => $data['package_number_id'],
            'package_volume_id' => $data['package_volume_id'],
        ];

        // act
        $response = $this->put(route('products.update', $product->id), $data);
        // assert
        $response->assertRedirect(route('products.show', $product->id));
        $this->assertDatabaseHas('products', $expectedData);

        $mobileImage = $product->mobileImage();
        $desktopImage = $product->desktopImage();
        $this->assertMediaExists($mobileImage);
        $this->assertMediaExists($desktopImage);
    }

    /**
     * @test
     */
    public function it_updates_product_with_existing_image(): void
    {
        // arrange
        $products = $this->setProducts(2);

        $product = $products->first();
        $media = $this->seedMedia();
        $mobileImage = $media->firstWhere('config', 'mobile');
        $desktopImage = $media->firstWhere('config', 'desktop');
        $packageNumbers = $this->setPackageNumber(2);
        $packageNumber = $packageNumbers->random()->id;
        $packageVolumes = $this->setPackageVolume(2);
        $packageVolume = $packageVolumes->random()->id;
        $data = [
            'name' => 'name',
            'description' => 'description',
            'package_number_id' => $packageNumber,
            'package_volume_id' => $packageVolume,
            'media_desktop_id' => $desktopImage->id,
            'media_mobile_id' => $mobileImage->id,
        ];
        $expectedData = [
            'id' => $product->id,
            'name' => $data['name'],
            'description' => $data['description'],
            'package_number_id' => $data['package_number_id'],
            'package_volume_id' => $data['package_volume_id'],
        ];
        $expectedMediaDesktopData = [
            'media_id' => $desktopImage->id,
            'mediable_type' => Product::class,
            'mediable_id' => $product->id
        ];

        $expectedMediaMobileData = [
            'media_id' => $mobileImage->id,
            'mediable_type' => Product::class,
            'mediable_id' => $product->id
        ];

        // act
        $response = $this->put(route('products.update', $product->id), $data);

        // assert
        $response->assertRedirect(route('products.show', $product->id));
        $this->assertDatabaseHas('products', $expectedData);
        $this->assertDatabaseHas('mediables', $expectedMediaDesktopData);
        $this->assertDatabaseHas('mediables', $expectedMediaMobileData);
    }

    /**
     * @test
     */
    public function it_fails_to_update_product_no_required_fields(): void
    {
        // arrange
        $products = $this->setProducts();
        $product = $products->first();
        $data = [];

        // act
        $response = $this->put(route('products.update', $product->id), $data);

        // assert
        $response->assertSessionHasErrors(['name', 'description', 'package_number_id', 'package_volume_id']);
    }

    /**
     * @test
     */
    public function it_fails_to_update_product_if_images_deleted(): void
    {
        // arrange
        $products = $this->setProducts();
        $product = $products->first();
        $data = [
            'name' => 'name',
            'description' => 'description',
            'package_number_id' => 1,
            'package_volume_id' => 5,
            'desktop_deleted' => true,
            'mobile_deleted' => true,
        ];

        // act
        $response = $this->put(route('products.update', $product->id), $data);

        // assert
        $response->assertSessionHasErrors(['image_desktop']);
        $response->assertSessionHasErrors(['image_mobile']);
    }

    /**
     * @test
     */
    public function it_fails_to_update_product_no_authorization(): void
    {
        // arrange
        $this->logoutUser();

        // act
        $response = $this->put(route('products.update', 1), []);

        // assert
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function it_reorders_products(): void
    {
        // arrange
        $this->setProducts(2);

        $data = ['items' => [['new' => 1, 'old' => 2], ['new' => 2, 'old' => 1]]];
        $expectedData = [
            ['id' => 1, 'position' => 2],
            ['id' => 2, 'position' => 1]
        ];

        // arrange
        $this->post(route('products.reorder'), $data);

        // assert
        $this->assertDatabaseHas('products', $expectedData[0]);
        $this->assertDatabaseHas('products', $expectedData[1]);
    }

    /**
     * @test
     */
    public function it_fails_to_reorder_products_no_required_sort_order(): void
    {
        // arrange
        $this->setProducts(2);
        $data = ['items' => [['new' => 99, 'old' => 98], ['new' => 97, 'old' => 98]]];

        // arrange
        $response = $this->post(route('products.reorder'), $data);

        // assert
        $response->assertSessionHasErrors(['items.0.new', 'items.1.new', 'items.0.old', 'items.1.old']);
    }

    /**
     * @test
     */
    public function it_deletes_product(): void
    {
        // arrange
        $products = $this->setProducts();
        $product = $products->first();

        // act
        $response = $this->delete(route('products.destroy', $product->id));

        // assert
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
        $response->assertRedirect(route('products.index'));
    }

    /**
     * @test
     */
    public function it_fails_to_delete_product_no_authorization(): void
    {
        // arrange
        $this->logoutUser();

        // act
        $response = $this->delete(route('products.destroy', 1));

        // assert
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * @param int $count
     * @return Collection
     */
    private function setProducts($count = 1): Collection
    {
        $packageNumber = $this->setPackageNumber(4);
        $packageVolume = $this->setPackageVolume(4);

        ProductFactory::resetPosition();
        return Product::factory()->count($count)->hasMedia(2)->create(
            ['package_number_id' => $packageNumber->random()->id, 'package_volume_id' => $packageVolume->random()->id]
        );
    }

    /**
     * @param int $count
     * @return Collection
     */
    protected function setPackageVolume($count = 1): Collection
    {
        return PackageVolume::factory()->count($count)->create();
    }

    /**
     * @param int $count
     * @return Collection
     */
    protected function setPackageNumber($count = 1): Collection
    {
        return PackageNumber::factory()->count($count)->create();
    }

    /**
     * @return void
     */
    protected function setProductsComponent(): void
    {
        StaticComponent::factory()->create(['type' => 'product']);
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
