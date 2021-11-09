<?php

namespace App\Models;

use App\Http\Resources\NewsApiResource;
use Illuminate\Database\Eloquent\Relations\HasMany;

class NewsComponent extends StaticComponent
{
    /** @var string $resourceApi */
    public $resourceApi = NewsApiResource::class;

    /**
     * @return HasMany
     */
    public function news(): HasMany
    {
        return $this->hasMany(News::class);
    }

    /**
     * @return HasMany
     */
    public function nonHighlightedNews(): HasMany
    {
        return $this->news()->highlighted(false);
    }

    /**
     * @return HasMany
     */
    public function content(): HasMany
    {
        return $this->nonHighlightedNews();
    }
}
