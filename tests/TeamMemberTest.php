<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;

uses(RefreshDatabase::class);

beforeEach(function () {
    Config::set('teams.models.user', Workbench\App\Models\User::class);
    $this->loadMigrationsFrom(__DIR__.'/../workbench/database/migrations');
});

it('can check if user is member of a team', function () {
    $team = \Workbench\App\Models\Team::create(['name' => 'Team 1']);
    $teamTwo = \Workbench\App\Models\Team::create(['name' => 'Team 2']);

    $user = \Workbench\App\Models\User::create(['name' => 'User 1', 'email' => 'test@example.com', 'password' => Hash::make('password')]);
    $team->addMember($user);

    expect($user->isMemberOf($team))->toBeTrue()
        ->and($user->isMemberOf($teamTwo))->toBeFalse();
});
