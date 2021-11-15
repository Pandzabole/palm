<?php

namespace App\Models;

use App\Models\ClassSubCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ClassCategory extends Model
{
    use HasFactory;

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [
        'classSubCategory',
    ];

    /**
     * @return string
     */
    public function slugable(): string
    {
        return $this->name;
    }

    /**
     * The roles that belong to the user.
     * @return BelongsToMany
     */
    public function classSubCategory(): BelongsToMany
    {
        return $this->belongsToMany(ClassSubCategory::class)->withTimestamps();
    }
}
