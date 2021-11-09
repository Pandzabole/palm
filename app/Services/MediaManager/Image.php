<?php

namespace App\Services\MediaManager;

use App\Services\MediaManager\Providers\ImageProvider;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\UploadedFile;

class Image extends Media
{
    /** @var array $responsiveImages */
    private $responsiveImages = [];

    /** @var ImageProvider $imageProvider */
    private $imageProvider;

    public function __construct(ImageProvider $imageProvider)
    {
        parent::__construct();

        $this->imageProvider = $imageProvider;
    }

    /**
     * @param UploadedFile $file
     * @param bool $withResponsive
     * @param bool $withThumb
     * @param string $imageType
     * @return Image
     */
    public function createFromUploadedFile(
        UploadedFile $file,
        string $imageType = "",
        bool $withResponsive = false,
        bool $withThumb = true
    ): Image
    {

        $this->setInfo($file);

        if ($withResponsive) {
            $this->setWithResponsive(true);
            $this->generateResponsive();
        }

        if ($withThumb) {
            $this->setWithThumb(true);
            $this->generateThumb();
        }

        $this->setImageType($imageType);

        return $this;
    }

    /**
     * @return array
     */
    public function getResponsiveDetails(): array
    {
        return $this->responsiveImages;
    }

    /**
     * @return void
     */
    protected function generateThumb(): void
    {
        $this->setThumbWidth(config('media.thumb.w'));
        $this->setThumbHeight(config('media.thumb.h'));
        $this->setThumbName($this->getFilename() . '-thumb.' . $this->getExtension());
    }

    /**
     * @return void
     */
    protected function generateResponsive(): void
    {
        $dimensions = config('media.responsive-images');

        foreach ($dimensions as $dimension) {
            $imageWidth = $dimension['w'];
            $imageHeight = $dimension['h'];

            $fileName = $this->getFilename() . '-' . $imageWidth . '.' . $this->getExtension();

            $this->responsiveImages[] = [
                'width' => $imageWidth,
                'height' => $imageHeight,
                'file_name' => $fileName
            ];
        }
    }

    /**
     * @return bool|string
     * @throws FileNotFoundException
     */
    public function getFileBlob()
    {
        return $this->getSource()->get();
    }

    /**
     * @return string
     * @throws FileNotFoundException
     */
    public function createThumb(): string
    {
        $fileBlob = $this->getFileBlob();
        $thumbWidth = $this->getThumbWidth();
        $thumbHeight = $this->getThumbHeight();
        $compressedBlob = $this->imageProvider->imageCompression($fileBlob);
        $thumbBlob = $this->imageProvider->createThumb($compressedBlob, $thumbWidth, $thumbHeight);
        $this->setThumbBlob($thumbBlob);

        return $thumbBlob;
    }

    /**
     * @param int $width
     * @param int $height
     * @return string
     * @throws FileNotFoundException
     */
    public function createResponsive(int $width, int $height): string
    {
        $fileBlob = $this->getFileBlob();

        $compressedBlob = $this->imageProvider->imageCompression($fileBlob);

        $image = $this->imageProvider->createResponsive($compressedBlob, $width, $height);

        $newHeight = $this->imageProvider->getImageHeight($image);

        $this->setResponsiveDetails($width, $newHeight);

        return $image;
    }

    /**
     * @param int $width
     * @param int $height
     */
    public function setResponsiveDetails(int $width, int $height): void
    {
        $details = $this->getResponsiveDetails();

        foreach ($details as &$detail) {
            if ($detail['width'] === $width) {
                $detail['height'] = $height;
                $this->responsiveImages = $details;

                return;
            }
        }
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'file_name' => $this->getFilename(),
            'directory' => $this->getDirectory(),
            'mime_type' => $this->getMimeType(),
            'extension' => $this->getExtension(),
            'size' => $this->getSize(),
            'thumb_name' => $this->getThumbName(),
            'responsive_images' => $this->getResponsiveDetails(),
            'file_blob' => base64_encode($this->getThumbBlob()),
            'config' => $this->getImageType(),

        ];
    }
}
