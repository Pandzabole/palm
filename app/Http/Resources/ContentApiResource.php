<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Repositories\Contracts\ContentRepository;

class ContentApiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        $parentResource = $this->resource->resource;

        $contentRepo = \app(ContentRepository::class);

        return $contentRepo->findByFilters(
            'sort_order',
            'asc',
            [
                'containable_type' => get_class($parentResource),
                'containable_id' => $this->id
            ],
            ['contentable']
        )->transform(
            static function ($content) {
                $content = $content->contentable;

                $response = [
                    'content_type' => $content->content_type
                ];

                return array_merge($response, $content->getResponseData());
            }
        )->toArray();
    }

    /**
     * @OA\Schema(
     *     schema="content-items",
     *     title="Content Items",
     *     type="array",
     *     @OA\Items(ref="#/components/schemas/content")
     * )
     */

    /**
     *    * @OA\Schema(
     *     schema="content",
     *     title="Content",
     *     type="array",
     *     @OA\Items(title="Content", anyOf={
     *         @OA\Schema(ref="#/components/schemas/rich-text-content"),
     *         @OA\Schema(ref="#/components/schemas/text-content"),
     *         @OA\Schema(ref="#/components/schemas/image-content"),
     *         @OA\Schema(ref="#/components/schemas/video-content"),
     *     }),
     * )
     */

    /**
     * @OA\Schema(
     *     schema="video-content",
     *     type="object",
     *     title="Video Content",
     *     required={"name", "content_type", "video", "video_meta"},
     *     @OA\Property(property="name", type="string", description="Content name"),
     *     @OA\Property(property="content_type", type="string", description="content_type"),
     *     @OA\Property(property="video", type="string", description="Content image"),
     *     @OA\Property(property="video_meta", type="object", ref="#/components/schemas/video-meta")
     * )
     */

    /**
     * @OA\Schema(
     *     schema="image-content",
     *     type="object",
     *     title="Image Content",
     *     required={"name", "content_type", "alt", "image", "image_meta"},
     *     @OA\Property(property="name", type="string", description="Content name"),
     *     @OA\Property(property="content_type", type="string", description="content_type"),
     *     @OA\Property(property="alt", type="string", description="Content alt"),
     *     @OA\Property(property="image", type="string", description="Content image"),
     *     @OA\Property(property="image_meta", type="object", ref="#/components/schemas/image-meta")
     * )
     */

    /**
     * @OA\Schema(
     *     schema="text-content",
     *     type="object",
     *     title="Text Content",
     *     required={"name", "content_type", "content", "text_type"},
     *     @OA\Property(property="name", type="string", description="Content name"),
     *     @OA\Property(property="content_type", type="string", description="content_type"),
     *     @OA\Property(property="content", type="string", description="Content content"),
     *     @OA\Property(property="text_type", type="string", description="Text content type")
     * )
     */

    /**
     * @OA\Schema(
     *     schema="rich-text-content",
     *     type="object",
     *     title="Rich Text Content",
     *     required={"name", "content_type", "content"},
     *     @OA\Property(property="name", type="string", description="Content name"),
     *     @OA\Property(property="content_type", type="string", description="content_type"),
     *     @OA\Property(property="content", type="string", description="Content content")
     * )
     */
}
