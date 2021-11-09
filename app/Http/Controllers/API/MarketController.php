<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\MarketApiResource;
use App\Repositories\Contracts\MarketsRepository;
use Illuminate\Http\Resources\Json\ResourceCollection;

class MarketController extends Controller
{
    /** @var MarketsRepository $marketsRepository */
    private $marketsRepository;

    /**
     * MarketController constructor.
     *
     * @param MarketsRepository $marketsRepository
     */
    public function __construct(MarketsRepository $marketsRepository)
    {
        $this->marketsRepository = $marketsRepository;
    }

    /**
     * @OA\Get(
     *     path="/api/market",
     *     tags={"Markets"},
     *     summary="Get all markets for selected lang. If not existing, get for deafult language.",
     *     operationId="getMarket",
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
     *         @OA\JsonContent(ref="#/components/schemas/market-resource")
     *     )
     * )
     * @return  ResourceCollection
     */
    public function showAllMarkets(): ResourceCollection
    {
        $markets = $this->marketsRepository->findByFilters('name', 'asc');

        return MarketApiResource::collection($markets);
    }
}
