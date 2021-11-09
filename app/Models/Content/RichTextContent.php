<?php

namespace App\Models\Content;

use App\Repositories\Contracts\RichTextContentRepository;
use App\Traits\Containable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RichTextContent extends Model
{
    use HasFactory;
    use Containable;

    /** @var string $table */
    protected $table = 'rich_text_content';

    /** @var string $formView */
    public $formView = 'vendor.content.forms.rich_text';

    /** @var string $showView */
    public $showView = 'vendor.content.shows.rich_text';

    /** @var string $repo */
    public $repo = RichTextContentRepository::class;

    /**
     * Validation rules for content
     *
     * @return array
     */
    public $rules = [
        'content' => 'required'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'content'
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
        return 'rich_text';
    }

    /**
     * @return string
     */
    public function getContentTypeNameAttribute(): string
    {
        return 'Rich Text';
    }

    /**
     * @return array
     */
    public function getResponseData(): array
    {
        return [
            'content' => $this->content
        ];
    }
}
