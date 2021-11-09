<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ActivityApiCollection extends ResourceCollection
{
    /**
     * The resource that this resource collects.
     *
     * @var string
     */
    public $collects = ActivityApiResource::class;

    /**
     * Transform the resource collection into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        self::$wrap = 'activity_items';

        return parent::toArray($request);
    }

    /**
     * @OA\Schema(
     *     schema="activity-resource",
     *     type="object",
     *     title="Activity Resource",
     *     required={"news_items", "links", "meta"},
     *     @OA\Property(property="activity_items", ref="#/components/schemas/activities"),
     *     @OA\Property(property="links", ref="#/components/schemas/pagination-links"),
     *     @OA\Property(property="meta", ref="#/components/schemas/pagination-meta"),
     * )
     */
}
