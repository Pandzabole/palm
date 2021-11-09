<?php

namespace App\Traits;

use App\Models\Publish;

trait Publishable
{
    protected static function bootPublishable(): void
    {
        static::creating(
            static function () {
                self::updatePublish();
            }
        );

        static::updating(
            static function () {
                self::updatePublish();
            }
        );

        static::deleting(
            static function () {
                self::updatePublish();
            }
        );
    }

    public static function updatePublish(): void
    {
        Publish::updateOrCreate(['id' => 1], ['status' => 0]);
    }
}
