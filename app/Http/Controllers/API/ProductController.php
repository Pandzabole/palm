<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\ProductApiResource;
use App\Repositories\Contracts\ProductsRepository;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProductController
{
    /** @var ProductsRepository $productsRepository */
    private $productsRepository;

    /**
     * ProductController constructor.
     *
     * @param ProductsRepository $productsRepository
     */
    public function __construct(ProductsRepository $productsRepository)
    {
        $this->productsRepository = $productsRepository;
    }

    /**
     * @OA\Get(
     *     path="/api/products",
     *     tags={"Products"},
     *     summary="Get products for language. If not existing, get products for default language.",
     *     operationId="getProducts",
     *     @OA\Parameter(
     *         name="lang",
     *         in="query",
     *         required=false,
     *         description="Send language short code",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/products")
     *     )
     * )
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $products = $this->productsRepository->findByFilters('position', 'asc');

        return ProductApiResource::collection($products);
    }

    /**
     * @OA\Get(
     *     path="/api/products/{slug}",
     *     tags={"Products"},
     *     summary="Get products by slug for selected language. If language does not exist, get product for default language.",
     *     operationId="getSingleProducts",
     *     @OA\Parameter(
     *         name="lang",
     *         in="query",
     *         required=false,
     *         description="Send language short code",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="slug",
     *         in="path",
     *         required=true,
     *         description="Send product slug",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/single-product")
     *     )
     * )
     *
     * @param string $slug
     * @return ProductApiResource
     */
    public function show(string $slug): ProductApiResource
    {
        $product = $this->productsRepository->findOneBy(['slug' => $slug]);

        return new ProductApiResource($product);
    }
}
