<?php

namespace Hexafuchs\Team\Traits;

use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait TeamMember
{
    /**
     * Defines the relationship between teams and their members.
     */
    public function teams(): BelongsToMany
    {
        assert($this instanceof User);
        return $this->belongsToMany(config('teams.models.team'));
    }
}
