<?php

namespace App\Traits;

use App\Models\Page;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait Pageable
{
    /**
     * @return MorphToMany
     */
    public function pages(): MorphToMany
    {
        return $this->morphToMany(Page::class, 'component');
    }
}
