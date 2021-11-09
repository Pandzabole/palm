<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\NewsApiCollection;
use App\Http\Resources\NewsApiResource;
use App\Repositories\Contracts\NewsRepository;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /** @var NewsRepository $newsRepository */
    private $newsRepository;

    /**
     * NewsController constructor.
     *
     * @param NewsRepository $newsRepository
     */
    public function __construct(NewsRepository $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    /**
     * @OA\Get(
     *     path="/api/news",
     *     tags={"News"},
     *     summary="Get news for language. If not existing, get news for default language.",
     *     operationId="getNews",
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
     *         @OA\JsonContent(ref="#/components/schemas/news")
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

        $news = $this->newsRepository
            ->findByCategorySlug($category, $limit, $paginate, $criteria, $orderParam, $orderType);

        return NewsApiResource::collection($news);
    }

    /**
     * @OA\Get(
     *     path="/api/news/paginate",
     *     tags={"News"},
     *     summary="Get paginated news for language. If not existing, get news for default language.",
     *     operationId="getNewsPaginated",
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
     *         description="Search for text in news content",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/news-resource")
     *     )
     * )
     *
     * @param Request $request
     * @return NewsApiCollection
     */
    public function indexPaginate(Request $request): NewsApiCollection
    {
        $category = $request->get('category');
        $limit = $request->get('limit', 5);
        $paginate = true;
        $criteria = $request->get('search');
        $orderParam = 'position';
        $orderType = 'asc';

        $news = $this->newsRepository
            ->findByCategorySlug($category, $limit, $paginate, $criteria, $orderParam, $orderType);

        return new NewsApiCollection($news);
    }

    /**
     * @OA\Get(
     *     path="/api/news/highlighted",
     *     tags={"News"},
     *     summary="Get highlighted news for language. If not existing, get highlighted news for default language.",
     *     operationId="getHighlightedNews",
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
     *         @OA\JsonContent(ref="#/components/schemas/single-news")
     *     )
     * )
     * @return NewsApiResource
     */
    public function showHighlighted(): NewsApiResource
    {
        $news = $this->newsRepository->findOneHighlighted();
        $news->sendResponseContentData();

        return new NewsApiResource($news);
    }

    /**
     * @OA\Get(
     *     path="/api/news/{slug}",
     *     tags={"News"},
     *     summary="Get news by slug for selected language. If language does not exist, get news for default language.",
     *     operationId="getSingleNews",
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
     *         description="Send news slug",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/single-news")
     *     )
     * )
     *
     * @param string $slug
     * @return NewsApiResource
     */
    public function show(string $slug): NewsApiResource
    {
        $news = $this->newsRepository->findOneBy(['slug' => $slug]);
        $news->sendResponseContentData();
        $news->sendResponseMetaData();

        return new NewsApiResource($news);
    }
}
