<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SliderItemApiResource extends JsonResource
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
            'type' => '',
            'tag' => '',
            'slug' => '',
            'position' => '',
            'description' => '',
            'title' => [
                'primary' => '',
                'secondary' => '',
                'sub_title' => '',
            ],
            'cta' => [
                'text' => $this->cta,
                'url' => $this->url,
                'url_type' => 'internal'
            ],
            'image' => new ImageApiResource($this),
        ];
    }
    /**
     * @OA\Schema(
     *     schema="slider-resource",
     *     type="array",
     *     title="Slider resource",
     *     @OA\Items(ref="#/components/schemas/slider-item"),
     * )
     */

    /**
     * @OA\Schema(
     *     schema="slider-item",
     *     type="object",
     *     title="Slider Item",
     *     allOf={@OA\Schema(ref="#/components/schemas/component")},
     *     @OA\Property(property="image", ref="#/components/schemas/image"),
     * )
     */
}
