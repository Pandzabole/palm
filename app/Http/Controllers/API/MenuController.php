<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\PagesRepository;
use App\Http\Resources\MenuApiCollection;

class MenuController extends Controller
{
    /** @var PagesRepository $pagesRepository */
    private $pagesRepository;

    /**
     * MenuController constructor.
     *
     * @param PagesRepository $pagesRepository
     */
    public function __construct(PagesRepository $pagesRepository)
    {
        $this->pagesRepository = $pagesRepository;
    }

    /**
     * @OA\Get(
     *     path="/api/menu",
     *     tags={"Menu"},
     *     summary="Get all pages for selected lang. If not existing, get for deafult language.",
     *     operationId="getMenu",
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
     *         @OA\JsonContent(ref="#/components/schemas/menu-resource")
     *     )
     * )
     *
     * @return  MenuApiCollection
     */
    public function showAllPages(): MenuApiCollection
    {
        $pages = $this->pagesRepository->findByFilters();

        return new MenuApiCollection($pages);
    }
}
