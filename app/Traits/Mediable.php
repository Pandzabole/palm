<?php

namespace App\Traits;

use App\Models\Media;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait Mediable
{
    /**
     * @return MorphToMany
     */
    public function media(): MorphToMany
    {
        return $this->morphToMany(Media::class, 'mediable', 'mediables');
    }

    /**
     * @return Media|null
     */
    public function firstMedia(): ?Media
    {
        return $this->media()->first();
    }

    /**
     * @return Media|null
     */
    public function firstImage(): ?Media
    {
        return $this->media()->images()->first();
    }

    /**
     * @return Media|null
     */
    public function firstVideo(): ?Media
    {
        return $this->media()->videos()->first();
    }

    /**
     * @return null|string
     */
    public function firstMediaUrl(): ?string
    {
        return optional($this->firstMedia())->getUrl();
    }

    /**
     * @param string $data
     * @return null|string
     */
    public function responsiveSingleImage(string $data): ?string
    {
        return optional($this->firstMedia())->getUrlResponsive($data);
    }

    /**
     * @return null|string
     */
    public function firstMediaThumb(): ?string
    {
        return optional($this->firstMedia())->getThumbUrl();
    }

    /**
     * @param Media|null $media
     * @return null|array
     */
    public function firstMediaMeta(Media $media = null): ?array
    {
        return optional($media ?? $this->firstMedia())->getImageMeta();
    }

    /**
     * @return null|array
     */
    public function firstImageMediaMetaData(): ?array
    {
        return optional($this->firstImage())->getFirstImageMetadata();
    }

    /**
     * @return Media|null
     */
    public function mobileImage(): ?Media
    {
        return $this->media->where('config', Media::MOBILE)->first();
    }

    /**
     * @return Media|null
     */
    public function desktopImage(): ?Media
    {
        return $this->media->where('config', Media::DESKTOP)->first();
    }

    /**
     * @param string $type
     * @return Media|null
     */
    public function getImageByType(string $type): ?Media
    {
        return $this->media()->where('config', $type)->first();
    }
}
