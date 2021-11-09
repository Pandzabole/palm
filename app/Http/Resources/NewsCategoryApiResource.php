<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NewsCategoryApiResource extends JsonResource
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
            'slug' => $this->slug,
        ];
    }

    /**
     * @OA\Schema(
     *     schema="news-categories",
     *     title="News Categories",
     *     type="array",
     *     @OA\Items(ref="#/components/schemas/news-category")
     * )
     */

    /**
     * @OA\Schema(
     *     schema="news-category",
     *     type="object",
     *     title="News Category",
     *     required={"name", "slug"},
     *     @OA\Property(property="name", type="string", description="News category name"),
     *     @OA\Property(property="slug", type="string", description="News category slug"),
     * )
     */
}
