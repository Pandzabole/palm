<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ActivityCategoryApiResource;
use App\Repositories\Contracts\ActivityCategoriesRepository;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ActivityCategoriesController extends Controller
{
    /** @var ActivityCategoriesRepository $activityCategoriesRepository */
    private $activityCategoriesRepository;

    /**
     * ActivityCategoriesController constructor.
     *
     * @param ActivityCategoriesRepository $activityCategoriesRepository
     */
    public function __construct(ActivityCategoriesRepository $activityCategoriesRepository)
    {
        $this->activityCategoriesRepository = $activityCategoriesRepository;
    }

    /**
     * @OA\Get(
     *     path="/api/activities/categories",
     *     tags={"Activities"},
     *     summary="Get activity categories. If not existing, get activity categories for default language.",
     *     operationId="getAllActivityCategories",
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
     *         @OA\JsonContent(ref="#/components/schemas/activity-categories")
     *     )
     * )
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $activityCategories = $this->activityCategoriesRepository->findByFilters();

        return ActivityCategoryApiResource::collection($activityCategories);
    }
}
