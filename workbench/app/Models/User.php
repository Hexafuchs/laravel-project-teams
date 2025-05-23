<?php

namespace Workbench\App\Models;

use Hexafuchs\Team\Traits\TeamMember;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use TeamMember;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];
}
