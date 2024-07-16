<?php

namespace Hexafuchs\Team\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait Ownable
{
    /**
     * Defines the morphed relationship between teams and their items.
     */
    public function owners(): MorphToMany
    {
        assert($this instanceof Model);
        return $this->morphToMany(config('teams.models.team'), 'ownable');
    }
}
