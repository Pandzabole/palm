<?php

namespace App\Traits;

use App\Models\Content\Content;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait Contentable
{
    /**
     * @return MorphMany
     */
    public function contents(): MorphMany
    {
        return $this->morphMany(Content::class, 'containable');
    }
}
