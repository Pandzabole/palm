<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ClassCategory extends Model
{
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
