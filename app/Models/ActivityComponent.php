<?php

namespace App\Models;

use App\Http\Resources\ActivityApiResource;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ActivityComponent extends StaticComponent
{
    /** @var string $resourceApi */
    public $resourceApi = ActivityApiResource::class;

    /**
     * @return HasMany
     */
    public function activities(): HasMany
    {
        return $this->hasMany(Activity::class);
    }

    /**
     * @return HasMany
     */
    public function content(): HasMany
    {
        return $this->activities();
    }
}
