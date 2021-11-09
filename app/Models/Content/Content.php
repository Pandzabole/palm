<?php

namespace App\Models\Content;

use App\Traits\Publishable;
use App\Traits\Sortable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Content extends Model
{
    use Sortable;
    use HasFactory;
    use Publishable;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'containable_type',
        'containable_id',
        'contentable_type',
        'contentable_id',
        'sort_order',
    ];

    /**
     * @return MorphTo
     */
    public function containable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * @return MorphTo
     */
    public function contentable(): MorphTo
    {
        return $this->morphTo();
    }
}
