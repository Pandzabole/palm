<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

class NewsApiResource extends JsonResource
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
            'date' => $this->created_at->format('d.m.Y'),
            'highlighted' => (bool)$this->highlighted,
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
        return $categories->transform(
            static function ($category) {
                return [
                    'name' => $category->name,
                    'slug' => $category->slug,
                ];
            }
        )->toArray();
    }

    /**
     * @OA\Schema(
     *     schema="news",
     *     title="News",
     *     type="array",
     *     @OA\Items(ref="#/components/schemas/single-news")
     * )
     */

    /**
     * @OA\Schema(
     *     schema="single-news",
     *     type="object",
     *     title="Single news",
     *     required={"position", "title", "desription", "slug", "date", "highlighted", "categories", "image", "image_meta"},
     *     @OA\Property(property="position", type="integer", description="News position"),
     *     @OA\Property(property="title", type="string", description="News title"),
     *     @OA\Property(property="desription", type="string", description="News desription"),
     *     @OA\Property(property="slug", type="string", description="News slug"),
     *     @OA\Property(property="date", type="string", description="News date"),
     *     @OA\Property(property="highlighted", type="boolean", description="Highlighted News"),
     *     @OA\Property(property="categories", ref="#/components/schemas/news-categories"),
     *     @OA\Property(property="image", type="string", description="News image"),
     *     @OA\Property(property="image_meta", type="object", ref="#/components/schemas/image-meta"),
     *     @OA\Property(property="content", ref="#/components/schemas/content"),
     *     @OA\Property(property="meta_data", type="object", ref="#/components/schemas/meta-data"),
     * )
     */
}
