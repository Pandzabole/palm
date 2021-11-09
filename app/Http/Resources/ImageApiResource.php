<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ImageApiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        $imageDesktop = $this->desktopImage();
        $imageMobile = $this->mobileImage();

        return [
            'desktop' => [
                'image_url' => optional($imageDesktop)->getUrl(),
                'base64' => optional($imageDesktop)->getImageBlob(),
            ],
            'mobile' => [
                'image_url' => optional($imageMobile)->getUrl(),
                'base64' => optional($imageMobile)->getImageBlob(),
            ]
        ];
    }

    /**
     * @OA\Schema(
     *     schema="image",
     *     type="object",
     *     title="Image",
     *     @OA\Property(property="desktop", ref="#/components/schemas/image-data"),
     *     @OA\Property(property="mobile", ref="#/components/schemas/image-data"),
     * )
     */

    /**
     * @OA\Schema(
     *     schema="image-data",
     *     type="object",
     *     title="Image data",
     *     @OA\Property(property="image_url", type="string", description="Image url"),
     *     @OA\Property(property="base64", type="string", description="Image base64"),
     * )
     */
}
