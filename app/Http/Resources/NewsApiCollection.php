<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class NewsApiCollection extends ResourceCollection
{
    /**
     * The resource that this resource collects.
     *
     * @var string
     */
    public $collects = NewsApiResource::class;

    /**
     * Transform the resource collection into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        self::$wrap = 'news_items';

        return parent::toArray($request);
    }

    /**
     * @OA\Schema(
     *     schema="news-resource",
     *     type="object",
     *     title="News Resource",
     *     required={"news_items", "links", "meta"},
     *     @OA\Property(property="news_items", ref="#/components/schemas/news"),
     *     @OA\Property(property="links", ref="#/components/schemas/pagination-links"),
     *     @OA\Property(property="meta", ref="#/components/schemas/pagination-meta"),
     * )
     */
}
