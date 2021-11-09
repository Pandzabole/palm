<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\MetaDataApiResource;
use App\Repositories\Contracts\PagesRepository;

class MetaDataController extends Controller
{
    /** @var PagesRepository $pagesRepository */
    private $pagesRepository;

    /**
     * MetaDataController constructor.
     *
     * @param PagesRepository $pagesRepository
     */
    public function __construct(PagesRepository $pagesRepository)
    {
        $this->pagesRepository = $pagesRepository;
    }

    /**
     * @OA\Get(
     *     path="/api/meta-data/{slug}",
     *     tags={"Meta Data"},
     *     summary="Get meta data by slug for selected language. If language does not exist, get meta data for default language.",
     *     operationId="getMetaData",
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
     *         description="Send meta data slug",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/meta-data-resource")
     *     )
     * )
     *
     * @param string $slug
     * @return MetaDataApiResource
     */
    public function show(string $slug): MetaDataApiResource
    {
        $metaData = $this->pagesRepository->findOneBy(['slug' => $slug])->metaData;

        return new MetaDataApiResource($metaData);
    }
}
