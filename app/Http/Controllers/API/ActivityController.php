<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ActivityApiCollection;
use App\Http\Resources\ActivityApiResource;
use App\Repositories\Contracts\ActivitiesRepository;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /** @var ActivitiesRepository $activitiesRepository */
    private $activitiesRepository;

    /**
     * ActivityController constructor.
     *
     * @param ActivitiesRepository $activitiesRepository
     */
    public function __construct(ActivitiesRepository $activitiesRepository)
    {
        $this->activitiesRepository = $activitiesRepository;
    }

    /**
     * @OA\Get(
     *     path="/api/activities",
     *     tags={"Activities"},
     *     summary="Get activites for language. If not existing, get activites for default language.",
     *     operationId="getActivities",
     *     @OA\Parameter(
     *         name="lang",
     *         in="query",
     *         required=false,
     *         description="Send language short code",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="category",
     *         in="query",
     *         required=false,
     *         description="Send category slug",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/activities")
     *     )
     * )
     *
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $category = $request->get('category');
        $limit = $request->get('limit', 5);
        $paginate = false;
        $criteria = [];
        $orderParam = 'position';
        $orderType = 'asc';

        $activities = $this->activitiesRepository
            ->findByCategorySlug($category, $limit, $paginate, $criteria, $orderParam, $orderType);

        return ActivityApiResource::collection($activities);
    }

    /**
     * @OA\Get(
     *     path="/api/activities/paginate",
     *     tags={"Activities"},
     *     summary="Get paginated activities for language. If not existing, get activities for default language.",
     *     operationId="getActivitiesPaginated",
     *     @OA\Parameter(
     *         name="lang",
     *         in="query",
     *         required=false,
     *         description="Send language short code",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="category",
     *         in="query",
     *         required=false,
     *         description="Send category slug",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         required=false,
     *         description="Send page number",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="limit",
     *         in="query",
     *         required=false,
     *         description="Send limit per page",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="search",
     *         in="query",
     *         required=false,
     *         description="Search for text in activities content",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/activity-resource")
     *     )
     * )
     *
     * @param Request $request
     * @return ActivityApiCollection
     */
    public function indexPaginate(Request $request): ActivityApiCollection
    {
        $limit = $request->get('limit', 5);
        $category = $request->get('category');
        $criteria = $request->get('search') ? ['description',  'like', '%' . $request->get('search') . '%'] : [];
        $orderParam = 'position';
        $orderType = 'asc';

        $activities = $this->activitiesRepository
            ->findByCategorySlug($category, $limit, true, $criteria, $orderParam, $orderType);

        return new ActivityApiCollection($activities);
    }

    /**
     * @OA\Get(
     *     path="/api/activities/{slug}",
     *     tags={"Activities"},
     *     summary="Get activities by slug for selected language. If language does not exist, get activities for default language.",
     *     operationId="getSingleActivity",
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
     *         description="Send activity slug",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/single-activity")
     *     )
     * )
     *
     * @param string $slug
     * @return ActivityApiResource
     */
    public function show(string $slug): ActivityApiResource
    {
        $activity = $this->activitiesRepository->findOneBy(['slug' => $slug]);
        $activity->sendResponseContentData();
        $activity->sendResponseMetaData();

        return new ActivityApiResource($activity);
    }
}
