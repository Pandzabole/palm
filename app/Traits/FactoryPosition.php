<?php

namespace App\Traits;

trait FactoryPosition
{
    /** @var int $position */
    public static $position = 1;

    /**
     * Reset position to default value
     */
    public static function resetPosition(): void
    {
        self::$position = 1;
    }
}
