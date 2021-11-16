<?php

namespace App\Models;

use App\Models\ClassCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ClassSubCategory extends Model
{
    use HasFactory;

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [
        'classCategory',
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
    public function classCategory(): BelongsToMany
    {
        return $this->belongsToMany(ClassCategory::class)->withTimestamps();
    }
}
