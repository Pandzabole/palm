<?php

/**
 * @OA\Info(
 *     version="1.0",
 *     title="Voda Voda API"
 * )
 */

/**
 * @OA\Schema(
 *     schema="image-meta",
 *     type="object",
 *     title="Image meta",
 *     required={"base64", "responsive", "thumb"},
 *     @OA\Property(property="base64", type="string", description="Base64 image representation"),
 *     @OA\Property(property="responsive", type="array", @OA\Items(ref="#/components/schemas/responsive-image")),
 *     @OA\Property(property="thumb", type="string", description="Thumb url")
 * )
 */

/**
 * @OA\Schema(
 *     schema="base",
 *     type="object",
 *     title="Base",
 *     @OA\Property(property="title", type="string", description="Title"),
 *     @OA\Property(property="sub_title", type="string", description="Sub title"),
 *     @OA\Property(property="cta", type="object", ref="#/components/schemas/cta"),
 * )
 */

/**
 * @OA\Schema(
 *     schema="slider-image",
 *     type="object",
 *     title="Image",
 *     required={"desktop", "mobile"},
 *     @OA\Property(property="desktop", type="object", ref="#/components/schemas/desktop"),
 *     @OA\Property(property="mobile", type="object", ref="#/components/schemas/mobile"),
 * )
 */

/**
 * @OA\Schema(
 *     schema="desktop",
 *     type="object",
 *     title="Desktop",
 *     required={"image_url", "base64"},
 *     @OA\Property(property="image_url", type="string", description="Url to the page"),
 *     @OA\Property(property="base64", type="string", description="Base64 image representation"),
 * )
 */

/**
 * @OA\Schema(
 *     schema="mobile",
 *     type="object",
 *     title="Mobile",
 *     required={"image_url", "base64"},
 *     @OA\Property(property="image_url", type="string", description="Url to the page"),
 *     @OA\Property(property="base64", type="string", description="Base64 image representation"),
 * )
 */

/**
 * @OA\Schema(
 *     schema="video-meta",
 *     type="object",
 *     title="Video meta",
 *     required={"thumb"},
 *     @OA\Property(property="thumb", type="string", description="Thumb url")
 * )
 */

/**
 * @OA\Schema(
 *     schema="video",
 *     type="object",
 *     title="Video",
 *     required={"video"},
 *     @OA\Property(property="video", type="string")
 * )
 */

/**
 * @OA\Schema(
 *     schema="responsive-image",
 *     type="object",
 *     title="Responsive Image meta",
 *     required={"width", "height", "image"},
 *     @OA\Property(property="width", type="integer"),
 *     @OA\Property(property="height", type="integer"),
 *     @OA\Property(property="image", type="string")
 * )
 */

/**
 * @OA\Schema(
 *     schema="pagination-links",
 *     type="object",
 *     title="Pagination Links",
 *     required={"first", "last", "prev", "next"},
 *     @OA\Property(property="first", type="string"),
 *     @OA\Property(property="last", type="string"),
 *     @OA\Property(property="prev", type="string"),
 *     @OA\Property(property="next", type="string")
 * )
 */

/**
 * @OA\Schema(
 *     schema="pagination-meta",
 *     type="object",
 *     title="Pagination Meta",
 *     required={"current_page", "from", "last_page", "path", "per_page", "to", "total"},
 *     @OA\Property(property="current_page", type="integer"),
 *     @OA\Property(property="from", type="integer"),
 *     @OA\Property(property="last_page", type="integer"),
 *     @OA\Property(property="path", type="string"),
 *     @OA\Property(property="per_page", type="integer"),
 *     @OA\Property(property="to", type="integer"),
 *     @OA\Property(property="total", type="integer")
 * )
 */

/**
 * @OA\Schema(
 *     schema="meta-data",
 *     type="object",
 *     title="Meta data",
 *     required={"title", "keywords", "description", "image"},
 *     @OA\Property(property="title", type="string", description="Meta title"),
 *     @OA\Property(property="keywords", type="string", description="Meta keywords"),
 *     @OA\Property(property="description", type="string", description="Meta description"),
 *     @OA\Property(property="image", type="string", description="Meta image"),
 * )
 */
