<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\NewsCategoryApiResource;
use App\Repositories\Contracts\NewsCategoriesRepository;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class NewsCategoriesController extends Controller
{
    /** @var NewsCategoriesRepository $newsCategoriesRepository */
    private $newsCategoriesRepository;

    /**
     * NewsCategoriesController constructor.
     *
     * @param NewsCategoriesRepository $newsCategoriesRepository
     */
    public function __construct(NewsCategoriesRepository $newsCategoriesRepository)
    {
        $this->newsCategoriesRepository = $newsCategoriesRepository;
    }

    /**
     * @OA\Get(
     *     path="/api/news/categories",
     *     tags={"News"},
     *     summary="Get news categories. If not existing, get news categories for default language.",
     *     operationId="getAllNewsCategories",
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
     *         @OA\JsonContent(ref="#/components/schemas/news-categories")
     *     )
     * )
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $newsCategories = $this->newsCategoriesRepository->findByFilters();

        return NewsCategoryApiResource::collection($newsCategories);
    }
}
