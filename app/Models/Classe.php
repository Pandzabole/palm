<?php

namespace App\Models;

use App\Models\ClassLocation;
use App\Models\ClassCategory;
use App\Models\ClassSubCategory;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
     * @return HasMany
     */
    public function classLocation(): HasMany
    {
        return $this->hasMany(ClassLocation::class);
    }

    /**
     * Get the classCategory for the classes.
     * @return HasMany
     */
    public function classCategory(): HasMany
    {
        return $this->hasMany(ClassCategory::class);
    }

    /**
     * Get the comments for the classes.
     * @return HasMany
     */
    public function classSubCategory(): HasMany
    {
        return $this->hasMany(ClassSubCategory::class);
    }

    /**
     * Get the comments for the classes.
     * @return HasMany
     */
    public function teachers(): HasMany
    {
        return $this->hasMany(Teacher::class);
    }
}
