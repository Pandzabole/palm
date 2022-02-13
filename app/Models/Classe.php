<?php

namespace App\Models;

use App\Traits\Mediable;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;


class Classe extends Model
{
    use Mediable;
    use HasFactory;
    use HasUuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'uuid',
        'name',
        'description',
        'price_usd',
        'price_eur',
        'price_omr',
        'price_sar',
        'map_location',
        'position',
        'highlighted',
        'class_category_id',
        'class_sub_category_id',
        'teacher_id',
        'discount',
        'discount_percentage',
        'popular',
        'description_first',
        'description_second',
        'level',
        'class_length',
        'age_restriction',
        'materials'
    ];

    protected $with = [
        'classCategory',
        'classSubCategory',
        'teacher',
        'locations',
        'media',
        'review'
    ];

    protected $casts = [
        'discount' => 'boolean',
        'highlighted' => 'boolean',
        'popular' => 'boolean'
    ];

    /**
     * @return BelongsTo
     */
    public function classCategory(): BelongsTo
    {
        return $this->belongsTo(ClassCategory::class);
    }

    /**
     * @return BelongsTo
     */
    public function classSubCategory(): BelongsTo
    {
        return $this->belongsTo(ClassSubCategory::class);
    }

    /**
     * @return BelongsTo
     */
    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }

    /**
     * @return BelongsToMany
     */
    public function locations(): BelongsToMany
    {
        return $this->belongsToMany(ClassLocation::class);
    }

    /**
     * @return HasOne
     */
    public function review(): HasOne
    {
        return $this->hasOne(Review::class);
    }
}
