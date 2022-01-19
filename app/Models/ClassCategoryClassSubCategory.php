<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ClassCategoryClassSubCategory extends Pivot

{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

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
}
