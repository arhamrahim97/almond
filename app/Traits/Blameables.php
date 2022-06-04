<?php

namespace App\Traits;

use App\Observers\BlameableObserver;

trait Blameables
{
    public static function bootBlameables()
    {
        static::observe(BlameableObserver::class);
    }
}
