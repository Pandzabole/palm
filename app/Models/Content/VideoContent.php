<?php

namespace App\Models\Content;

use App\Repositories\Contracts\VideoContentRepository;
use App\Traits\Containable;
use App\Traits\Mediable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoContent extends Model
{
    use Mediable;
    use HasFactory;
    use Containable;

    /** @var string $table */
    protected $table = 'video_content';

    /** @var string $formView */
    public $formView = 'vendor.content.forms.video';

    /** @var string $showView */
    public $showView = 'vendor.content.shows.video';

    /** @var string $repo */
    public $repo = VideoContentRepository::class;

    protected $fillable = [
        'name',
    ];

    /**
     * Validation rules for content
     *
     * @return array
     */
    public $rules = [
        'video' => 'nullable|required_without:media_id|mimetypes:video/x-ms-asf,video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/avi',
        'media_id' => 'nullable|required_without:video|exists:media,id',
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
        return 'video';
    }

    /**
     * @return string
     */
    public function getContentTypeNameAttribute(): string
    {
        return 'Video';
    }

    /**
     * @return array
     */
    public function getResponseData(): array
    {
        return [
            'video' => $this->firstMediaUrl(),
            'video_meta' => $this->firstMediaMeta(),
        ];
    }
}
