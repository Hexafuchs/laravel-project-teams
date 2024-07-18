<?php

namespace Hexafuchs\Team;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Team extends Model {

    /**
     * Variables that can me mass assigned (e.g. using the `::create` function).
     */
    protected $fillable = [
        'name'
    ];

    /**
     * Returns all team members (or the corresponding relation).
     *
     * You can configure the model type of team members using `teams.model.user`
     */
    public function members(): BelongsToMany
    {
        return $this->belongsToMany(config('teams.model.user'));
    }
}
