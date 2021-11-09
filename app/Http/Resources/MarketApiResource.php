<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MarketApiResource extends JsonResource
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
            'href' => $this->href,
        ];
    }

    /**
     * @OA\Schema(
     *     schema="market-resource",
     *     type="object",
     *     title="Market",
     *     @OA\Property(property="market_items", ref="#/components/schemas/market_items"),
     * )
     */

    /**
     * @OA\Schema(
     *     schema="market_items",
     *     type="array",
     *     title="Market Items",
     *     @OA\Items(ref="#/components/schemas/single_market_item"),
     * )
     */

    /**
     * @OA\Schema(
     *     schema="single_market_item",
     *     type="object",
     *     title="Market Item",
     *     required={"name", "slug", "href"},
     *     @OA\Property(property="name", type="string", description="Page name"),
     *     @OA\Property(property="href", type="string", description="Page href"),
     * )
     */
}
