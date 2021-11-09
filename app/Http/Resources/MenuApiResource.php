<?php

namespace App\Http\Resources;

use App\Repositories\Contracts\MarketsRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MenuApiResource extends JsonResource
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
            'name' => $this->name,
            'slug' => $this->slug,
            'href' => $this->href,
            'children' => []
        ];

        if ($this->isMarkets()) {
            $markets = \app(MarketsRepository::class)->findByFilters('name', 'asc');
            $response['children'] = MarketApiResource::collection($markets);
        }

        return $response;
    }
    /**
     * @OA\Schema(
     *     schema="menu-resource",
     *     type="object",
     *     title="Menu",
     *     required={"menu_items"},
     *     @OA\Property(property="menu_items", ref="#/components/schemas/menu_items"),
     * )
     */

    /**
     * @OA\Schema(
     *     schema="menu_items",
     *     type="array",
     *     title="Menu Items",
     *     @OA\Items(ref="#/components/schemas/single_menu_item"),
     * )
     */

    /**
     * @OA\Schema(
     *     schema="single_menu_item",
     *     type="object",
     *     title="Menu Item",
     *     required={"name", "slug", "href"},
     *     @OA\Property(property="name", type="string", description="Page name"),
     *     @OA\Property(property="slug", type="string", description="Page slug"),
     *     @OA\Property(property="href", type="string", description="Page href"),
     *     @OA\Property(property="children", ref="#/components/schemas/children"),
     * )
     */

    /**
     * @OA\Schema(
     *     schema="children",
     *     type="array",
     *     title="Children",
     *     @OA\Items(ref="#/components/schemas/markets-items"),
     * )
     */

    /**
     * @OA\Schema(
     *     schema="markets-items",
     *     type="object",
     *     title="Markets items",
     *     required={"name", "href"},
     *     @OA\Property(property="name", type="string", description="Language name"),
     *     @OA\Property(property="href", type="string", description="Language href"),
     * )
     */
}
