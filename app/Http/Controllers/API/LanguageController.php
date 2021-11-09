<?php

namespace App\Http\Controllers\API;

use App\Repositories\Contracts\LanguagesRepository;
use App\Http\Resources\LanguageApiResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\ResourceCollection;

class LanguageController extends Controller
{
    /** @var LanguagesRepository $languagesRepository */
    private $languagesRepository;

    /**
     * LanguageController constructor.
     *
     * @param LanguagesRepository $languagesRepository
     */
    public function __construct(LanguagesRepository $languagesRepository)
    {
        $this->languagesRepository = $languagesRepository;
    }

    /**
     * @OA\Get(
     *     path="/api/languages",
     *     tags={"Languages"},
     *     summary="Get all available languages.",
     *     operationId="getAllLanguages",
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/languages")
     *     )
     * )
     *
     * @return  ResourceCollection
     */
    public function showAllLanguages(): ResourceCollection
    {
        $languages = $this->languagesRepository->findByFilters();

        return LanguageApiResource::collection($languages);
    }
}
