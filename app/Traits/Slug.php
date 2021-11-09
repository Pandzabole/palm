<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait Slug
{
    /**
     * @return string
     */
    public function slugable(): string
    {
        return uniqid('', true);
    }

    /**
     * @return void
     */
    protected static function bootSlug(): void
    {
        static::creating(static function (Model $model) {
            $model->slug = self::generateSlug($model);
        });

        static::updating(static function (Model $model) {
            $model->slug = self::generateSlug($model);
        });
    }

    /**
     * @param $model
     * @return string
     */
    private static function generateSlug($model): string
    {
        $slug =  Str::slug($model->slugable());
        $hasSlug = $model->newQuery()->where([
            ['slug', '=', $slug],
            ['id', '!=', $model->id],
        ])->first();

        if ($hasSlug) {
            $slug .= '-' . uniqid('', true);
        }

        return $slug;
    }
}
