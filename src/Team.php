<?php

namespace Hexafuchs\Team;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Team extends Model {

    protected $fillable = [
        'name'
    ];

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(config('teams.model.user'));
    }
}
