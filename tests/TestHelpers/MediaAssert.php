<?php

namespace Tests\TestHelpers;

use Illuminate\Support\Facades\Storage;

trait MediaAssert
{
    /**
     * Assert media original image, thumb and responsive images that exists on file system
     *
     * @param $media
     * @param bool $checkResponsive
     */
    public function assertMediaExists($media, $checkResponsive = true): void
    {
        $this->assertDatabaseHas('media', ['id' => $media->id]);
        $paths = [$media->path, $media->directory . '/' . $media->base_file_name];

        if ($checkResponsive) {
            foreach ($media->responsive_images as $responsiveImage) {
                $paths[] = $media->directory . '/' . $responsiveImage['file_name'];
            }
        }

        Storage::disk('public')->assertExists($paths);
    }
}
