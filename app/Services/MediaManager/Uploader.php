<?php

namespace App\Services\MediaManager;

use Illuminate\Support\Facades\Storage;

class Uploader
{
    /**
     * @param Media $media
     */
    public function upload(Media $media): void
    {
        $this->saveOriginal($media);

        if ($media->isWithThumb()) {
            $this->saveThumb($media);
        }

        if ($media->isWithResponsive()) {
            $this->saveResponsive($media);
        }
    }

    /**
     * @param Media $media
     */
    public function saveOriginal(Media $media): void
    {
        $dir = $media->getDirectory();
        $fileName = $media->getOriginalFilename();

        $media->getSource()->storePubliclyAs($dir, $fileName, ['disk' => 'public']);
    }

    /**
     * @param Media $media
     */
    public function saveThumb(Media $media): void
    {
        $thumb = $media->createThumb();
        $dir = $media->getDirectory();
        $thumbName = $media->getThumbName();

        Storage::disk('public')->put($dir . '/' . $thumbName, $thumb);
    }

    /**
     * @param Media $media
     */
    public function saveResponsive(Media $media): void
    {
        $responsive = $media->getResponsiveDetails();
        $dir = $media->getDirectory();

        foreach ($responsive as $image) {
            $img = $media->createResponsive($image['width'], $image['height']);

            Storage::disk('public')->put($dir . '/' . $image['file_name'], $img);
        }
    }
}
