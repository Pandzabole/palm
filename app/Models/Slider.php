<?php

namespace App\Models;

use App\Http\Resources\SliderItemApiResource;
use App\Traits\Pageable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Slider extends Model
{
    use Pageable;
    use HasFactory;

    /** @var string $type */
    public $type = 'slider';

    /** @var string $resourceApi */
    public $resourceApi = SliderItemApiResource::class;

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [
        'steps'
    ];

    /**
     * @return HasMany
     */
    public function steps(): HasMany
    {
        return $this->hasMany(SliderItem::class);
    }

    /**
     * @return HasMany
     */
    public function content(): HasMany
    {
        return $this->steps();
    }
}
