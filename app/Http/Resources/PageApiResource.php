<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PageApiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        $components = collect();

        collect($this->getRelations())->map(
            function ($collection) use ($components) {
                $components->push(ComponentsApiResource::collection($collection)->resource);
            }
        );

        return [
            'page' => [
                'name' => $this->name,
                'slug' => $this->slug,
                'href' => $this->href,
            ],
            'components' => $components->flatten(1)
        ];
    }

    /**
     * @OA\Schema(
     *     schema="page",
     *     title="Page",
     *     type="object",
     *     required={"page", "components"},
     *     @OA\Property(property="page", ref="#/components/schemas/page_details"),
     *     @OA\Property(property="components", ref="#/components/schemas/components"),
     * )
     */

    /**
     * @OA\Schema(
     *     schema="page_details",
     *     type="object",
     *     title="Page Details",
     *     required={"name", "slug", "href"},
     *     @OA\Property(property="name", type="string", description="Page name"),
     *     @OA\Property(property="slug", type="string", description="Page slug"),
     *     @OA\Property(property="href", type="string", description="Page href"),
     * )
     */

    /**
     * @OA\Schema(
     *     schema="components",
     *     title="Page Components",
     *     type="array",
     *     @OA\Items(ref="#/components/schemas/page-component"),
     * )
     */
}
