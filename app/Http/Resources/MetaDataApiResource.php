<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

class MetaDataApiResource extends JsonResource
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
            'title' => $this->title,
            'keywords' => explode(',', $this->keywords),
            'description' => $this->description,
            'image' => $this->firstMediaUrl(),
        ];
    }

    /**
     * @OA\Schema(
     *     schema="meta-data-resource",
     *     type="object",
     *     title="Meta data",
     *     @OA\Property(property="meta_data_items", ref="#/components/schemas/meta-data"),
     * )
     */
}
