<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LanguageApiResource extends JsonResource
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
            'native_name' => $this->native_name,
            'short' => $this->short
        ];
    }

    /**
     * @OA\Schema(
     *     schema="languages",
     *     title="Languages",
     *     type="array",
     *     @OA\Items(ref="#/components/schemas/language")
     * )
     */

    /**
     * @OA\Schema(
     *     schema="language",
     *     type="object",
     *     title="Language",
     *     required={"name", "native_name", "short"},
     *     @OA\Property(property="name", type="string", description="Language name"),
     *     @OA\Property(property="native_name", type="string", description="Language native name"),
     *     @OA\Property(property="short", type="string", description="Language short code"),
     * )
     */
}
