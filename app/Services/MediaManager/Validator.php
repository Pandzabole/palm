<?php

namespace App\Services\MediaManager;

use Illuminate\Http\UploadedFile;

class Validator
{
    /**
     * @param UploadedFile $file
     * @return string|null
     */
    public function checkType(UploadedFile $file): ?string
    {
        $mimeType = $file->getClientMimeType();
        $type = null;

        if (strpos($mimeType, 'video/') !== false) {
            $type = 'video';
        } elseif (strpos($mimeType, 'image/') !== false) {
            $type = 'image';
        }

        return $type;
    }
}
