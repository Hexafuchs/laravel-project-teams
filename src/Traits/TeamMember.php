<?php

namespace Hexafuchs\Team\Traits;

use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait TeamMember
{
    /**
     * Returns all teams the user is member of (or the corresponding relation).
     *
     * The user must be an instance of `\Illuminate\Foundation\Auth\User` (if you use the default template, you will
     * find this to be aliased as `Authenticatable` in the default user class).
     *
     * You can configure the team model using `teams.models.team`.
     */
    public function teams(): BelongsToMany
    {
        assert($this instanceof User);
        return $this->belongsToMany(config('teams.models.team'));
    }
}
