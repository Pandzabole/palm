<?php

namespace App\Services\MediaManager\Providers;

use Imagick;
use Exception;
use RuntimeException;

class ImageProvider
{
    /**
     * @var Imagick
     */
    private $imagick;

    public function __construct(Imagick $imagick)
    {
        $this->imagick = $imagick;
    }

    /**
     * @param string $file
     * @param int $width
     * @param int $height
     * @return string
     */
    public function createThumb(string $file, int $width, int $height): string
    {
        $this->readSourceFile($file);
        $this->imagick->thumbnailImage($width, $height);

        return $this->imagick->getImageBlob();
    }

    /**
     * @param $file
     * @return bool
     * @throws RuntimeException
     */
    public function readSourceFile($file): bool
    {
        try {
            return $this->imagick->readImageBlob($file);
        } catch (Exception $e) {
            throw new RuntimeException("Could not read the file. Error: {$e->getMessage()}");
        }
    }

    /**
     * @param string $file
     * @return int
     */
    public function getImageWidth(string $file): int
    {
        $this->readSourceFile($file);
        return $this->imagick->getImageWidth();
    }

    /**
     * @param string $file
     * @return int
     */
    public function getImageHeight(string $file): int
    {
        $this->readSourceFile($file);
        return $this->imagick->getImageHeight();
    }

    /**
     * @param string $file
     * @param int $width
     * @param int $height
     * @return string
     */
    public function createResponsive(string $file, int $width, int $height): string
    {
        try {
            $this->readSourceFile($file);
            $this->imagick->ScaleImage($width, $height);
        } catch (Exception $e) {
            throw new RuntimeException("Could not create responsive images. Error: {$e->getMessage()}");
        }

        return $this->imagick->getImageBlob();
    }

    /**
     * @param int $quality
     * @param string $fileBlob
     * @return string
     */
    public function imageCompression(string $fileBlob, int $quality = 85): string
    {
        $this->readSourceFile($fileBlob);
        $this->imagick->gaussianBlurImage(0.5, 10);  //blur
        $this->imagick->setCompressionQuality($quality);
        $this->imagick->stripImage(); // Strip any comment or exif tag

        return $this->imagick->getImageBlob();
    }
}
