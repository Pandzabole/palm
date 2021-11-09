<?php

namespace App\Models;

use App\Http\Resources\StaticComponentsApiResource;
use App\Traits\Publishable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Pageable;
use App\Traits\Slug;
use App\Traits\Mediable;

class StaticComponent extends Model
{
    use Slug;
    use Mediable;
    use Pageable;
    use HasFactory;
    use Publishable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'static_components';

    /** @var string $resourceApi */
    public $resourceApi = StaticComponentsApiResource::class;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'id',
        'tag',
        'primary_title',
        'secondary_title',
        'sub_title',
        'description',
        'cta',
        'url',
        'cta_type',
        'slug',
        'type',
        'position',
        'config'
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [
        'media'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'config' => 'array'
    ];

    /**
     * @return string
     */
    public function slugable(): string
    {
        return $this->primary_title;
    }

    /**
     * @param Builder $query
     * @param string $type
     * @return Builder
     */
    public function scopeType(Builder $query, string $type): Builder
    {
        return $query->where('type', $type);
    }

    /**
     * @return mixed
     */
    public function childInstance()
    {
        $childClass = config("relationships.page.$this->type.class");

        return new $childClass($this->attributes);
    }

    /**
     * @return bool
     */
    public function isCtaTypeExternal(): bool
    {
        return $this->cta_type === 'external';
    }

    /**
     * @return array|mixed
     */
    public function getConfigImageDesktopAttribute(): ?array
    {
        return data_get($this->config, 'image.desktop');
    }


    /**
     * @return array|mixed
     */
    public function getConfigImageMobileAttribute(): ?array
    {
        return data_get($this->config, 'image.mobile');
    }
}
