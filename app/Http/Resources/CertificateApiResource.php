<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CertificateApiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'name' => $this->name,
            'image' => $this->firstMediaUrl(),
            'image_meta' => $this->firstMediaMeta()
        ];
    }

    /**
     * @OA\Schema(
     *     schema="certificates",
     *     title="Certificates",
     *     type="array",
     *     @OA\Items(ref="#/components/schemas/single-certificate")
     * )
     */

    /**
     * @OA\Schema(
     *     schema="single-certificate",
     *     type="object",
     *     title="Single certificate",
     *     required={"name", "image", "image_meta"},
     *     @OA\Property(property="name", type="string", description="Product title"),
     *     @OA\Property(property="image", type="string", description="Product image"),
     *     @OA\Property(property="image_meta", type="object", ref="#/components/schemas/image-meta")
     * )
     */
}
