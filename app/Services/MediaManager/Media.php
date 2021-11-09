<?php

namespace App\Services\MediaManager;

use Illuminate\Http\UploadedFile;

class Media
{
    /** @var string $filename */
    protected $filename;

    /** @var string $extension */
    protected $extension;

    /** @var int $size */
    protected $size;

    /** @var string $mimeType */
    protected $mimeType;

    /** @var string $directory */
    protected $directory;

    /** @var UploadedFile $source */
    protected $source;

    /** @var bool $withThumb */
    protected $withThumb = false;

    /** @var bool $withResponsive */
    protected $withResponsive = false;

    /** @var int $thumbWidth */
    protected $thumbWidth;

    /** @var string $imageType */
    protected $imageType;

    /** @var string $thumbName */
    protected $thumbName;

    /** @var string $thumbHeight */
    protected $thumbHeight;

    /** @var string $thumbBlob */
    protected $thumbBlob;

    protected function __construct()
    {
    }

    /**
     * @param UploadedFile $file
     *
     */
    protected function setInfo(UploadedFile $file): void
    {
        $uid = uniqid('', true);
        $this->setSource($file);
        $this->setFilename($uid);
        $this->setDirectory($uid);
        $this->setExtension($file->guessClientExtension());
        $this->setSize($file->getSize());
        $this->setMimeType($file->getClientMimeType());
    }

    /**
     * @return string
     */
    public function getDirectory(): string
    {
        return $this->directory;
    }

    /**
     * @return string
     */
    public function getFilename(): string
    {
        return $this->filename;
    }

    /**
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * @return string
     */
    public function getExtension(): string
    {
        return $this->extension;
    }

    /**
     * @return string
     */
    public function getMimeType(): string
    {
        return $this->mimeType;
    }

    /**
     * @return UploadedFile
     */
    public function getSource(): UploadedFile
    {
        return $this->source;
    }

    /**
     * @return string
     */
    public function getThumbBlob(): string
    {
        return $this->thumbBlob ?? '';
    }

    /**
     * @return string
     */
    public function getOriginalFilename(): string
    {
        return $this->getFilename() . '.' . $this->getExtension();
    }

    /**
     * @return bool
     */
    public function isWithThumb(): bool
    {
        return $this->withThumb;
    }

    /**
     * @return bool
     */
    public function isWithResponsive(): bool
    {
        return $this->withResponsive;
    }

    /**
     * @return string
     */
    public function getThumbName(): string
    {
        return $this->thumbName;
    }

    /**
     * @return string
     */
    public function getThumbWidth(): string
    {
        return $this->thumbWidth;
    }

    /**
     * @return string
     */
    public function getThumbHeight(): string
    {
        return $this->thumbHeight;
    }

    /**
     * @return string
     */
    public function getImageType(): string
    {
        return $this->imageType;
    }

    /**
     * @param UploadedFile $source
     */
    public function setSource(UploadedFile $source): void
    {
        $this->source = $source;
    }

    /**
     * @param int $width
     */
    public function setThumbWidth(int $width): void
    {
        $this->thumbWidth = $width;
    }

    /**
     * @param int $height
     */
    public function setThumbHeight(int $height): void
    {
        $this->thumbHeight = $height;
    }

    /**
     * @param string $thumbName
     */
    public function setThumbName(string $thumbName): void
    {
        $this->thumbName = $thumbName;
    }

    /**
     * @param string $filename
     */
    public function setFilename(string $filename): void
    {
        $this->filename = $filename;
    }

    /**
     * @param string $extension
     */
    public function setExtension(string $extension): void
    {
        $this->extension = $extension;
    }

    /**
     * @param int $size
     */
    public function setSize(int $size): void
    {
        $this->size = $size;
    }

    /**
     * @param string
     */
    public function setMimeType(string $mimeType): void
    {
        $this->mimeType = $mimeType;
    }

    /**
     * @param string $directory
     */
    public function setDirectory(string $directory): void
    {
        $this->directory = $directory;
    }

    /**
     * @param bool $withThumb
     */
    public function setWithThumb(bool $withThumb): void
    {
        $this->withThumb = $withThumb;
    }

    /**
     * @param bool $withResponsive
     */
    public function setWithResponsive(bool $withResponsive): void
    {
        $this->withResponsive = $withResponsive;
    }

    /**
     * @param string $base64
     */
    public function setThumbBlob(string $base64): void
    {
        $this->thumbBlob = $base64;
    }

    /**
     * @param string $imageType
     */
    public function setImageType(string $imageType): void
    {
        $this->imageType = $imageType;
    }
}
