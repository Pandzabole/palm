<?php

namespace App\Models\Content;

use App\Repositories\Contracts\ImageContentRepository;
use App\Traits\Containable;
use App\Traits\Mediable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageContent extends Model
{
    use Mediable;
    use HasFactory;
    use Containable;

    /** @var string $table */
    protected $table = 'image_content';

    /** @var string $formView */
    public $formView = 'vendor.content.forms.image';

    /** @var string $showView */
    public $showView = 'vendor.content.shows.image';

    /** @var string $repo */
    public $repo = ImageContentRepository::class;

    /**
     * Validation rules for content
     *
     * @return array
     */
    public $rules = [
        'alt' => 'nullable|string',
        'image' => 'nullable|required_without:media_id|mimes:jpeg,bmp,png',
        'media_id' => 'nullable|required_without:image|exists:media,id',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'alt',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'content_type',
        'content_type_name',
    ];

    /**
     * @return string
     */
    public function getContentTypeAttribute(): string
    {
        return 'image';
    }

    /**
     * @return string
     */
    public function getContentTypeNameAttribute(): string
    {
        return 'Image';
    }

    /**
     * @return array
     */
    public function getResponseData(): array
    {
        return [
            'alt' => $this->alt,
            'image' => $this->firstMediaUrl(),
            'image_meta' => $this->firstMediaMeta(),
        ];
    }
}
