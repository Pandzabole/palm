<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StaticComponentsApiResource extends JsonResource
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
            'image' => new ImageApiResource($this)
        ];
    }

    /**
     * @OA\Schema(
     *     schema="static-component",
     *     type="object",
     *     title="Static Component",
     *     @OA\Property(property="image", ref="#/components/schemas/image"),
     * )
     */
}
