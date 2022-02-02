<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ClassSubCategory extends Model
{
    use HasFactory;
    use HasUuid;

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [
        'classCategory',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'uuid',
        'name',
    ];

    /**
     * The roles that belong to the user.
     * @return BelongsToMany
     */
    public function classCategory(): BelongsToMany
    {
        return $this->belongsToMany(ClassCategory::class)->withTimestamps();
    }
}
