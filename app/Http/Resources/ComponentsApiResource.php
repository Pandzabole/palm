<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ComponentsApiResource extends JsonResource
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
            'type' => $this->type,
            'tag' => $this->tag,
            'slug' => $this->slug,
            'position' => $this->position,
            'description' => $this->description,
            'title' => [
                'primary' => $this->primary_title,
                'secondary' => $this->secondary_title,
                'sub_title' => $this->sub_title,
            ],
            'cta' => [
                'text' => $this->cta,
                'url' => $this->url,
                'url_type' => $this->cta_type
            ],
            'content' => $this->content ? $this->resourceApi::collection($this->content) : new $this->resourceApi($this)
        ];
    }

    /**
     * @OA\Schema(
     *     schema="page-component",
     *     type="object",
     *     title="Page Component",
     *     allOf={@OA\Schema(ref="#/components/schemas/component")},
     *     @OA\Property(property="content", oneOf={
     *                  @OA\Schema(ref="#/components/schemas/slider-resource"),
     *                  @OA\Schema(ref="#/components/schemas/news"),
     *                  @OA\Schema(ref="#/components/schemas/activities"),
     *                  @OA\Schema(ref="#/components/schemas/static-component")
     *          })
     * )
     */

    /**
     * @OA\Schema(
     *     schema="component",
     *     type="object",
     *     title="Component",
     *     @OA\Property(property="type", type="string", description="Type"),
     *     @OA\Property(property="tag", type="string", description="Tag"),
     *     @OA\Property(property="slug", type="string", description="Slug"),
     *     @OA\Property(property="position", type="integer", description="Position"),
     *     @OA\Property(property="description", type="string", description="Description"),
     *     @OA\Property(property="title", ref="#/components/schemas/title"),
     *     @OA\Property(property="cta", ref="#/components/schemas/cta"),
     * )
     */

    /**
     * @OA\Schema(
     *     schema="title",
     *     type="object",
     *     title="Component Title",
     *     @OA\Property(property="primary", type="string", description="Primary title"),
     *     @OA\Property(property="secondary", type="string", description="Secondary title"),
     *     @OA\Property(property="sub_title", type="string", description="Sub title"),
     * )
     */

    /**
     * @OA\Schema(
     *     schema="cta",
     *     type="object",
     *     title="Component CTA",
     *     @OA\Property(property="text", type="string", description="CTA text"),
     *     @OA\Property(property="url", type="string", description="CTA url"),
     *     @OA\Property(property="url_type", type="string", description="CTA url type"),
     * )
     */
}
