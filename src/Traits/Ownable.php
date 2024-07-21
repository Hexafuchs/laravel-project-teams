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

    public function addTeam(Team $team): void
    {
        $this->owners()->attach($team);
    }

    public function removeTeam(Team $team): void
    {
        $this->owners()->detach($team['id']);
        $this->refresh();
    }

    public function isOwnedBy(Team $team): bool
    {
        return $this->owners()->where('id', $team['id'])->exists();
    }
}
