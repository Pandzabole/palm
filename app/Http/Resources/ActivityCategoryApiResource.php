<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ActivityCategoryApiResource extends JsonResource
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
     *     schema="activity-categories",
     *     title="Activity Categories",
     *     type="array",
     *     @OA\Items(ref="#/components/schemas/activity-category")
     * )
     */

    /**
     * @OA\Schema(
     *     schema="activity-category",
     *     type="object",
     *     title="Activity Category",
     *     required={"name", "slug"},
     *     @OA\Property(property="name", type="string", description="News category name"),
     *     @OA\Property(property="slug", type="string", description="News category slug"),
     * )
     */
}
