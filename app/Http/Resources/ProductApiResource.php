<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductApiResource extends JsonResource
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
            'position' => $this->position,
            'name' => $this->name,
            'description' => $this->description,
            'slug' => $this->slug,
            'packageVolume' => $this->packageVolume->value,
            'packageNumber' => $this->packageNumber->value,
            'image' => new ImageApiResource($this),
        ];
    }

    /**
     * @OA\Schema(
     *     schema="products",
     *     title="Products",
     *     type="array",
     *     @OA\Items(ref="#/components/schemas/single-product")
     * )
     */

    /**
     * @OA\Schema(
     *     schema="single-product",
     *     type="object",
     *     title="Single product",
     *     required={"position", "name", "desription", "slug", "packageVolume", "packageNumber", "image", "image_meta"},
     *     @OA\Property(property="position", type="integer", description="Product position"),
     *     @OA\Property(property="name", type="string", description="Product title"),
     *     @OA\Property(property="desription", type="string", description="Product desription"),
     *     @OA\Property(property="slug", type="string", description="Product slug"),
     *     @OA\Property(property="packageVolume", type="string", description="Product Package volume"),
     *     @OA\Property(property="packageNumber", type="integer", description="Product Package number"),
     *     @OA\Property(property="image", ref="#/components/schemas/image"),
     *     @OA\Property(property="content", ref="#/components/schemas/content"),
     * )
     */
}
