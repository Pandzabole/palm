<?php

namespace Feature\Controllers\API;

use App\Models\PackageNumber;
use App\Models\PackageVolume;
use App\Models\Product;
use Illuminate\Support\Collection;
use Tests\ContentTestCase;

class ProductControllerTest extends ContentTestCase
{
    /** @var Collection $products */
    private $products;

    /** @var Collection $packageVolume */
    private $packageVolume;

    /** @var Collection $packageNumber */
    private $packageNumber;

    /**
     * @test
     * @return void
     */
    public function it_returns_products(): void
    {
        // arrange
        $dataToAssert = $this->prepareProductsToAssert(5);

        // act
        $response = $this->getApiJsonResponse('products');

        // assert
        self::assertEquals($dataToAssert, $response->getData(true));
        $response->assertSuccessful();
    }

    /**
     * @test
     * @return void
     */
    public function it_returns_single_product_by_slug(): void
    {
        // arrange
        $dataToAssert = $this->prepareProductsToAssert()[0];
        $products = $this->products->first();

        // act
        $response = $this->getApiJsonResponse('products/' . $products['slug']);

        // assert
        $response->assertJson($dataToAssert);
        $response->assertSuccessful();
    }

    /**
     * @param int $count
     * @param bool $media
     * @return Collection
     */
    private function setProducts($count = 1, $media = true): Collection
    {
        $this->setPackageNumber(4);
        $this->setPackageVolume(4);

        $this->products = Product::factory()->count($count)->hasMedia()->create(
            [
                'package_number_id' => $this->packageNumber->random()->id,
                'package_volume_id' => $this->packageVolume->random()->id
            ]
        );

        return $this->products;
    }

    /**
     * @param int $count
     */
    protected function setPackageVolume($count = 1): void
    {
        $this->packageVolume = PackageVolume::factory()->count($count)->create();
    }

    /**
     * @param int $count
     */
    protected function setPackageNumber($count = 1): void
    {
        $this->packageNumber = PackageNumber::factory()->count($count)->create();
    }

    /**
     * @param null $products
     * @param int $count
     * @return array
     */
    private function prepareProductsToAssert($count = 1, $products = null): array
    {
        $products = $products ?? $this->setProducts($count);

        return $products->transform(
            function ($products) {
                return [
                    'position' => $products->position,
                    'name' => $products->name,
                    'description' => $products->description,
                    'packageVolume' => $products->packageVolume->value,
                    'packageNumber' => $products->packageNumber->value,
                    'slug' => $products->slug,
                    'image' => [
                        'desktop' => [
                            'image_url' => optional($products->desktopImage())->getUrl(),
                            'base64' => optional($products->desktopImage())->getImageBlob(),
                        ],
                        'mobile' => [
                            'image_url' => optional($products->mobileImage())->getUrl(),
                            'base64' => optional($products->mobileImage())->getImageBlob(),
                        ]
                    ],
                ];
            }
        )->values()->toArray();
    }
}
