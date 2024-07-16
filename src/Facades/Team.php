<?php

namespace Hexafuchs\Team\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Hexafuchs\Team\Team
 */
class Team extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Hexafuchs\Team\Team::class;
    }
}
