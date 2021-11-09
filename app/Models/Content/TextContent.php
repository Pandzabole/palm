<?php

namespace App\Models\Content;

use App\Repositories\Contracts\TextContentRepository;
use App\Traits\Containable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class TextContent extends Model
{
    use HasFactory;
    use Containable;

    /** @var string $table */
    protected $table = 'text_content';

    /** @var string $formView */
    public $formView = 'vendor.content.forms.text';

    /** @var string $showView */
    public $showView = 'vendor.content.shows.text';

    /** @var string $repo */
    public $repo = TextContentRepository::class;

    /**
     * Validation rules for content
     *
     * @return array
     */
    public $rules = [
        'type' => 'required',
        'content' => 'required|string'
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
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'type',
        'content',
    ];

    /**
     * @return Collection
     */
    public function getAllTypesAttribute(): Collection
    {
        return collect(config('content.text_types'));
    }

    /**
     * @return string
     */
    public function getContentTypeAttribute(): string
    {
        return 'text';
    }

    /**
     * @return string
     */
    public function getContentTypeNameAttribute(): string
    {
        return 'Text';
    }

    /**
     * @return array
     */
    public function getResponseData(): array
    {
        return [
            'content' => $this->content,
            'text_type' => $this->type,
        ];
    }
}
