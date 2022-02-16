<?php

namespace App\Models;

use App\Traits\Publishable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Media extends Model
{
    use HasFactory;
    use Publishable;

    /** @var string DESKTOP */
    public const DESKTOP = 'desktop';

    /** @var string MOBILE */
    public const MOBILE = 'mobile';

    /** @var string VIDEO */
    public const VIDEO = 'video';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'size',
        'mime_type',
        'file_name',
        'extension',
        'directory',
        'file_name',
        'file_blob',
        'thumb_name',
        'responsive_images',
        'config',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'responsive_images' => 'array',
    ];

    /**
     * @return string
     */
    public function getBaseFileNameAttribute(): string
    {
        return $this->file_name . '.' . $this->extension;
    }

    /**
     * @return string
     */
    public function getPathAttribute(): string
    {
        return $this->directory . '/' . $this->base_file_name;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return Storage::disk('public')->url($this->directory . '/' . $this->base_file_name);
    }
    /**
     * @param string $data
     * @return string
     */
    public function getUrlResponsive(string $data): string
    {
        return Storage::disk('public')->url($this->directory . '/' . $this->file_name . '-' . $data . '.' . $this->extension);
    }

    /**
     * @return string
     */
    public function getThumbUrl(): string
    {
        return Storage::disk('public')->url($this->directory . '/' . $this->thumb_name);
    }

    /**
     * @return string|null
     */
    public function getImageBlob(): ?string
    {
        return $this->file_blob;
    }

    /**
     * @return array
     */
    public function getImageMeta(): array
    {
        $thumb = $this->getThumbUrl();
        $base64 = $this->getImageBlob();
        $responsive = collect($this->responsive_images)->map(function ($image) {
            return [
                'width' => data_get($image, 'width'),
                'height' => data_get($image, 'height'),
                'image' => Storage::disk('public')->url($this->directory . '/' . data_get($image, 'file_name'))
            ];
        })->toArray();

        return compact('base64', 'thumb', 'responsive');
    }

    /**
     * @return array
     */
    public function getFirstImageMetadata(): array
    {
        return collect($this->responsive_images)->map(function ($image) {
            return [
                'width' => data_get($image, 'width'),
                'height' => data_get($image, 'height'),
                'image' => Storage::disk('public')->url($this->directory . '/' . data_get($image, 'file_name'))
            ];
        })->first();
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeImages(Builder $query): Builder
    {
        return $query->where('mime_type', 'like', 'image/%');
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeVideos(Builder $query): Builder
    {
        return $query->where('mime_type', 'like', 'video/%');
    }

    /**
     * @param Builder $query
     * @param string $type
     * @return Builder
     */
    public function scopeType(Builder $query, string $type): Builder
    {
        return $query->where('config', $type);
    }

    /**
     * @return bool
     */
    public function isDesktop(): bool
    {
        return $this->config === self::DESKTOP;
    }

    /**
     * @return bool
     */
    public function isMobile(): bool
    {
        return $this->config === self::MOBILE;
    }

    /**
     * @return bool
     */
    public function isVideo(): bool
    {
        return $this->config === self::VIDEO;
    }
}
