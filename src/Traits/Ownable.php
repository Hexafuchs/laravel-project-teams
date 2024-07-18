<?php

namespace Hexafuchs\Team\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait Ownable
{
    /**
     * Returns all teams that "own" this instance (or the corresponding relation).
     */
    public function owners(): MorphToMany
    {
        assert($this instanceof Model);
        return $this->morphToMany(config('teams.models.team'), 'ownable');
    }
}
