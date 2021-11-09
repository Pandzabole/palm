<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\PageApiResource;
use App\Repositories\Contracts\PagesRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ComponentsController
{
    /** @var PagesRepository $pagesRepository */
    public $pagesRepository;

    /**
     * ContentController constructor.
     *
     * @param PagesRepository $pagesRepository
     */
    public function __construct(PagesRepository $pagesRepository)
    {
        $this->pagesRepository = $pagesRepository;
    }

    /**
     * @OA\Get(
     *     path="/api/components/types",
     *     tags={"Components"},
     *     operationId="getComponentTypes",
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/component-types")
     *     )
     * )
     *
     * @return JsonResponse
     */
    public function indexTypes(): JsonResponse
    {
        $data = ['types' => array_keys(config('relationships.page'))];

        return response()->json($data);
    }

    /**
     * @OA\Schema(
     *     schema="component-types",
     *     title="List of Component Types",
     *     required={"types"},
     *     @OA\Property(property="types", ref="#/components/schemas/component-type"),
     * )
     */

    /**
     * @OA\Schema(
     *     schema="component-type",
     *     title="Component type",
     *     type="array",
     *     @OA\Items(type="string")
     * )
     */

    /**
     * @OA\Get(
     *     path="/api/components/{pageSlug}",
     *     tags={"Components"},
     *     operationId="getComponents",
     *    @OA\Parameter(
     *         name="pageSlug",
     *         in="path",
     *         required=true,
     *         description="Send page slug",
     *         @OA\Schema(type="string")
     *     ),
     *    @OA\Parameter(
     *         name="component",
     *         in="query",
     *         required=false,
     *         description="Send component slug",
     *         @OA\Schema(type="string")
     *     ),
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
     *         @OA\JsonContent(ref="#/components/schemas/page")
     *     )
     * )
     *
     * @param Request $request
     * @param string $pageSlug
     * @return PageApiResource
     */
    public function index(Request $request, string $pageSlug): PageApiResource
    {
        $component = $request->get('component');

        $page = $this->pagesRepository->getWithComponents($pageSlug, $component);

        return new PageApiResource($page);
    }
}
