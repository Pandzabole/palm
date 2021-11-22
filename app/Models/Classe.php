<?php

namespace App\Models;

use App\Traits\Mediable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Classe extends Model
{
    use Mediable;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'description',
        'price',
        'map_location',
        'position',
        'highlighted',
        'class_category_id',
        'class_sub_category_id',
        'teacher_id',
    ];

    protected $with = [
        'classCategory',
        'classSubCategory',
        'teacher',
        'locations',
        'media'
    ];

    /**
     * Get the classCategory for the classes.
     * @return BelongsTo
     */
    public function classCategory(): BelongsTo
    {
        return $this->belongsTo(ClassCategory::class);
    }

    /**
     * Get the comments for the classes.
     * @return BelongsTo
     */
    public function classSubCategory(): BelongsTo
    {
        return $this->belongsTo(ClassSubCategory::class);
    }

    /**
     * Get the comments for the classes.
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
}
