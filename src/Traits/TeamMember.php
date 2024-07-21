<?php

namespace Hexafuchs\Team\Traits;

use Hexafuchs\Team\Team;
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
     * You can configure the team model using `teams.models.team`, but it must inherit from `Hexafuchs\Team\Team`.
     */
    public function teams(): BelongsToMany
    {
        assert($this instanceof User);
        return $this->belongsToMany(config('teams.models.team'));
    }

    /**
     * Check if this instance is member of a given team.
     *
     * The user must be an instance of `\Illuminate\Foundation\Auth\User` (if you use the default template, you will
     *  find this to be aliased as `Authenticatable` in the default user class).
     *
     * You can configure the team model using `teams.models.team`, but it must inherit from `Hexafuchs\Team\Team`.
     */
    public function isMemberOf(Team $team): bool
    {
        assert($this instanceof User);
        return $this->teams()->where('id', $team['id'])->exists();
    }

    /**
     * Adds the user to a team.
     *
     * The user must be an instance of `\Illuminate\Foundation\Auth\User` (if you use the default template, you will
     * find this to be aliased as `Authenticatable` in the default user class).
     *
     * You can configure the team model using `teams.models.team`, but it must inherit from `Hexafuchs\Team\Team`.
     */
    public function addToTeam(Team $team): void {
        $team->addMember($this);
    }

    /**
     * Returns all teams the user is member of (or the corresponding relation).
     *
     * The user must be an instance of `\Illuminate\Foundation\Auth\User` (if you use the default template, you will
     * find this to be aliased as `Authenticatable` in the default user class).
     *
     * You can configure the team model using `teams.models.team`, but it must inherit from `Hexafuchs\Team\Team`.
     *
     * @param Team $team target team
     * @param bool $autoRefresh refresh this and the team model afterwards, false by default
     * @return void
     */
    public function removeFromTeam(Team $team, bool $autoRefresh = false): void {
        if ($this->isMemberOf($team)) {
            $team->removeMember($this, $autoRefresh);
        }
    }
}
