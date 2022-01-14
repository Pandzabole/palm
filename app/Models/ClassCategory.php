<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ClassCategory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
    ];

    /**
     * The roles that belong to the user.
     * @return BelongsToMany
     */
    public function classSubCategory(): BelongsToMany
    {
        return $this->belongsToMany(ClassSubCategory::class)->withTimestamps();
    }
}
