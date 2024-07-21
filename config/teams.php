<?php

// config for Hexafuchs/Team
return [
    'models' => [

        /*
        |--------------------------------------------------------------------------
        | Team Model Class
        |--------------------------------------------------------------------------
        |
        | Defines the model class to use for teams. Should extend
        | \Hexafuchs\Team\Team.
        |
        */
        'team' => \Hexafuchs\Team\Team::class,
        /*
        |--------------------------------------------------------------------------
        | User Model Class
        |--------------------------------------------------------------------------
        |
        | Defines the model class to use for users. Typically this is your default
        | \App\Models\User.
        |
        */
        'user' => \Illuminate\Foundation\Auth\User::class,
    ],

];
