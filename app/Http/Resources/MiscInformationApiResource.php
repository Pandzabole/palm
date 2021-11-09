<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MiscInformationApiResource extends JsonResource
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
            'quote' => $this->getData($this->resource['quote']),
            'emails' => $this->getDataCollection($this->resource['emails']),
            'phones' => $this->getDataCollection($this->resource['phones']),
            'socials' => $this->getDataCollection($this->resource['socials']),
            'addresses' => $this->getDataCollection($this->resource['addresses']),
        ];
    }

    /**
     * @param $resource
     * @return array
     */
    private function getData($resource): array
    {
        return [
            'name' => optional($resource)->name,
            'slug' => optional($resource)->slug,
            'value' => optional($resource)->value,
            'type' => optional($resource)->type,
        ];
    }

    /**
     * @param $resources
     * @return array
     */
    private function getDataCollection($resources): array
    {
        return $resources->map(
            function ($resource) {
                return $this->getData($resource);
            }
        )->toArray();
    }

    /**
     * @OA\Schema(
     *     schema="footer-information",
     *     title="Footer Information",
     *     required={"callCenter", "socials", "quote"},
     *     type="object",
     *     @OA\Property(property="quote", ref="#/components/schemas/single-misc-information"),
     *     @OA\Property(property="emails", ref="#/components/schemas/single-misc-information"),
     *     @OA\Property(property="phones", ref="#/components/schemas/single-misc-information"),
     *     @OA\Property(property="socials", ref="#/components/schemas/misc-information-resource"),
     *     @OA\Property(property="addresses", ref="#/components/schemas/misc-information-resource"),
     * )
     */

    /**
     * @OA\Schema(
     *     schema="misc-information-resource",
     *     title="Misc Information resource",
     *     type="array",
     *     @OA\Items(ref="#/components/schemas/single-misc-information")
     * )
     */

    /**
     * @OA\Schema(
     *     schema="single-misc-information",
     *     type="object",
     *     title="Single misc information",
     *     required={"name", "slug", "value", "type"},
     *     @OA\Property(property="name", type="string", description="Information name"),
     *     @OA\Property(property="slug", type="string", description="Information slug"),
     *     @OA\Property(property="value", type="string", description="Information text value"),
     *     @OA\Property(property="type", type="string", description="One of the available types")
     * )
     */
}
