<?php

namespace App\Models;

use App\Models\ClassLocation;
use App\Models\ClassCategory;
use App\Models\ClassSubCategory;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Classe extends Model
{
    use HasFactory;

    protected $with = [
        'classLocation',
        'classCategory',
        'classSubCategory',
        'teachers',
    ];

    /**
     * Get the comments for the classes.
     * @return BelongsTo
     */
    public function classLocation(): BelongsTo
    {
        return $this->belongsTo(ClassLocation::class);
    }

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
    public function teachers(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }
}
