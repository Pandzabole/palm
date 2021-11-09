<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\MiscInformationApiResource;
use App\Repositories\Contracts\MiscInformationRepository;

class MiscInformationController extends Controller
{
    /** @var MiscInformationRepository $miscInformationRepository */
    private $miscInformationRepository;

    /**
     * MiscInformationController constructor.
     *
     * @param MiscInformationRepository $miscInformationRepository
     */
    public function __construct(MiscInformationRepository $miscInformationRepository)
    {
        $this->miscInformationRepository = $miscInformationRepository;
    }

    /**
     * @OA\Get(
     *     path="/api/misc-information",
     *     tags={"Misc Information"},
     *     summary="Get other information data for selected lang. If not existing, get for deafult language.",
     *     operationId="getMiscInformation",
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
     *         @OA\JsonContent(ref="#/components/schemas/footer-information")
     *     )
     * )
     * @return MiscInformationApiResource
     */
    public function index(): MiscInformationApiResource
    {
        $miscInformation = $this->miscInformationRepository->findByFilters();

        $miscInformation = [
            'phones' => $miscInformation->where('type', 'phone'),
            'emails' => $miscInformation->where('type', 'email'),
            'quote' => $miscInformation->firstWhere('type', 'long-text'),
            'socials' => $miscInformation->where('type', 'external-link'),
            'addresses' => $miscInformation->where('type', 'address'),
        ];

        return new MiscInformationApiResource($miscInformation);
    }
}
