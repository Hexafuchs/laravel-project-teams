<?php

namespace Hexafuchs\Team\Traits;

use Hexafuchs\Team\Team;
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

    /**
     * Add the team as a (co-)owner of this instance
     */
    public function addTeam(Team $team): void
    {
        $this->owners()->attach($team);
    }

    /**
     * Remove the team as a (co-)owner of this instance
     *
     * @param Team $team target team
     * @param bool $autoRefresh refresh this and the team model afterwards, false by default
     * @return void
     */
    public function removeTeam(Team $team, bool $autoRefresh = false): void
    {
        $this->owners()->detach($team['id']);

        if ($autoRefresh) {
            $this->refresh();
            $team->refresh();
        }
    }

    /**
     * Check this instance is (co-)owned by the given team
     */
    public function isOwnedBy(Team $team): bool
    {
        return $this->owners()->where('id', $team['id'])->exists();
    }
}
