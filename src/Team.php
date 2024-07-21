<?php

namespace Hexafuchs\Team;

use Hexafuchs\Team\Traits\Ownable;
use Hexafuchs\Team\Traits\TeamMember;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User;

class Team extends Model
{
    /**
     * Variables that can me mass assigned (e.g. using the `::create` function).
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Returns all team members (or the corresponding relation).
     *
     * You can configure the model type of team members using `teams.model.user`
     */
    public function members(): BelongsToMany
    {
        return $this->belongsToMany(config('teams.models.user'));
    }

    /**
     * Checks if the object has the `Hexafuchs\Team\Traits\TeamMember` trait and the class configured in
     *  `teams.models.user` in the hierarchy.
     */
    protected function isTeamMemberObject(User $user): bool
    {
        $hasTrait = in_array(TeamMember::class, class_uses_recursive($user));
        $isChild = is_a($user, config('teams.models.user'));

        if (! app()->environment('production')) {
            assert($hasTrait);
            assert($isChild);
        }

        return $hasTrait && $isChild;
    }

    /**
     * Adds a user as team member.
     *
     * The model needs to have the `Hexafuchs\Team\Traits\TeamMember` trait and have the class configured in
     * `teams.models.user` in the hierarchy.
     */
    public function addMember(User $user)
    {
        if ($this->isTeamMemberObject($user)) {
            $this->members()->attach($user);
        }
    }

    /**
     * Removes a user as team member.
     *
     * The model needs to have the `Hexafuchs\Team\Traits\TeamMember` trait and have the class configured in
     * `teams.models.user` in the hierarchy.
     *
     * @param  User  $user  target team member
     * @param  bool  $autoRefresh  refresh this and the team member model afterwards, false by default
     */
    public function removeMember(User $user, bool $autoRefresh = false): void
    {
        if ($this->isTeamMemberObject($user)) {
            $this->members()->detach($user);

            if ($autoRefresh) {
                $this->refresh();
                $user->refresh();
            }
        }
    }

    /**
     * Checks it he object has the `Hexafuchs\Team\Traits\Ownable` trait
     */
    protected function isOwnableObject(Model $model): bool
    {
        $hasTrait = in_array(Ownable::class, class_uses_recursive($model));
        if (! app()->environment('production')) {
            assert($hasTrait);
        }

        return $hasTrait;
    }

    /**
     * Checks if this team is a (co-)owner of the given model.
     *
     * The model must have the `Hexafuchs\Team\Traits\Ownable` trait.
     */
    public function owns(Model $model): bool
    {
        if ($this->isOwnableObject($model)) {
            assert(method_exists($model, 'isOwnedBy'));

            return $model->isOwnedBy($this);
        }

        return false;
    }
}
