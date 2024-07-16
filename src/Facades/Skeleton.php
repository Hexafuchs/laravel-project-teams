<?php

namespace Hexafuchs\Skeleton\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Hexafuchs\Skeleton\Skeleton
 */
class Skeleton extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Hexafuchs\Skeleton\Skeleton::class;
    }
}
