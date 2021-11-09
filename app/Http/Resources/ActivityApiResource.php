<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

class ActivityApiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        $response = [
            'position' => $this->position,
            'title' => $this->title,
            'description' => $this->description,
            'slug' => $this->slug,
            'categories' => $this->getCategories($this->categories),
            'image' => $this->firstMediaUrl(),
            'image_meta' => $this->firstMediaMeta()
        ];

        if ($this->additionalData) {
            $response['content'] = new ContentApiResource($this);
        }

        if ($this->metaData) {
            $response['meta_data'] = [
                'title' => $this->title,
                'keywords' => explode(' ', $this->title),
                'description' => $this->description,
                'image' => $this->firstMediaUrl(),
            ];
        }

        return $response;
    }

    /**
     * @param Collection $categories
     * @return array
     */
    private function getCategories(Collection $categories): array
    {
        return $categories->transform(static function ($category) {
            return [
                'name' => $category->name,
                'slug' => $category->slug,
            ];
        })->toArray();
    }

    /**
     * @OA\Schema(
     *     schema="activities",
     *     title="Activities",
     *     type="array",
     *     @OA\Items(ref="#/components/schemas/single-activity")
     * )
     */

    /**
     * @OA\Schema(
     *     schema="single-activity",
     *     type="object",
     *     title="Single activity",
     *     required={"position", "title", "desription", "slug", "highlighted", "categories", "image", "image_meta"},
     *     @OA\Property(property="position", type="integer", description="Activity position"),
     *     @OA\Property(property="title", type="string", description="Activity title"),
     *     @OA\Property(property="desription", type="string", description="Activity desription"),
     *     @OA\Property(property="slug", type="string", description="Activity slug"),
     *     @OA\Property(property="categories", ref="#/components/schemas/activity-categories"),
     *     @OA\Property(property="image", type="string", description="Activity image"),
     *     @OA\Property(property="image_meta", type="object", ref="#/components/schemas/image-meta"),
     *     @OA\Property(property="meta_data", type="object", ref="#/components/schemas/meta-data"),
     *     @OA\Property(property="content", ref="#/components/schemas/content"),
     * )
     */
}
