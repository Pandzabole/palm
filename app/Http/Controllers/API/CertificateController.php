<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\CertificateApiResource;
use App\Repositories\Contracts\CertificatesRepository;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CertificateController
{
    /** @var CertificatesRepository $certificatesRepository */
    private $certificatesRepository;

    /**
     * ProductController constructor.
     *
     * @param CertificatesRepository $certificatesRepository
     */
    public function __construct(CertificatesRepository $certificatesRepository)
    {
        $this->certificatesRepository = $certificatesRepository;
    }

    /**
     * @OA\Get(
     *     path="/api/certificates",
     *     tags={"Certificates"},
     *     summary="Get certificates for language. If not existing, get products for default language.",
     *     operationId="getCertificates",
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
     *         @OA\JsonContent(ref="#/components/schemas/certificates")
     *     )
     * )
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $certificates = $this->certificatesRepository->findByFilters('created_at', 'asc');

        return CertificateApiResource::collection($certificates);
    }
}
