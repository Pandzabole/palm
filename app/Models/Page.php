<?php

namespace App\Models;

use App\Traits\Publishable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Page extends Model
{
    use HasFactory;
    use Publishable;

    /** @var string MARKETS */
    public const MARKETS = '/markets';

    /** @var array $morphRelationships */
    public $morphRelationships;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'href',
        'position',
        'cta_type'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'position' => 'int'
    ];

    /**
     * Page constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setMorphRelationships();

        foreach ($this->morphRelationships as $method => $relationship) {
            self::resolveRelationUsing($method, function () use ($relationship) {
                return $this->morphedByMany($relationship['class'], 'component');
            });
        }
    }

    /**
     * @return bool
     */
    public function isMarkets(): bool
    {
        return $this->href === self::MARKETS;
    }

    /**
     * @return void
     */
    public function setMorphRelationships(): void
    {
        $this->morphRelationships = config('relationships.page');
    }

    /**
     * @return HasOne
     */
    public function metaData(): HasOne
    {
        return $this->hasOne(MetaData::class);
    }
}
