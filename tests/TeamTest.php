<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;

uses(RefreshDatabase::class);

beforeEach(function () {
    Config::set('teams.models.user', Workbench\App\Models\User::class);
    $this->loadMigrationsFrom(__DIR__.'/../workbench/database/migrations');
});

it('can check if team owns ownable', function () {
    $team = \Workbench\App\Models\Team::create(['name' => 'Team 1']);
    $teamTwo = \Workbench\App\Models\Team::create(['name' => 'Team 2']);

    $item = \Workbench\App\Models\SomeItem::create();
    $item->addTeam($team);

    expect($team->owns($item))->toBeTrue()
        ->and($teamTwo->owns($item))->toBeFalse();
});

it('cannot check if team owns non-ownable', function () {
    $team = \Workbench\App\Models\Team::create(['name' => 'Team 1']);
    $teamTwo = \Workbench\App\Models\Team::create(['name' => 'Team 2']);

    expect($team->owns($teamTwo))->toBeFalse();
});

it('can add member to team', function () {
    $team = \Workbench\App\Models\Team::create(['name' => 'Team 1']);

    $user = \Workbench\App\Models\User::create(['name' => 'User 1', 'email' => 'test@example.com', 'password' => Hash::make('password')]);
    $userTwo = \Workbench\App\Models\User::create(['name' => 'User 2', 'email' => 'test2@example.com', 'password' => Hash::make('password')]);

    $team->addMember($user);
    $team->addMember($userTwo);

    expect($team->members->pluck('id'))
        ->toHaveCount(2)
        ->toContain($user->id, $userTwo->id);
});

it('can remove member from team', function () {
    $team = \Workbench\App\Models\Team::create(['name' => 'Team 1']);

    $user = \Workbench\App\Models\User::create(['name' => 'User 1', 'email' => 'test@example.com', 'password' => Hash::make('password')]);
    $userTwo = \Workbench\App\Models\User::create(['name' => 'User 2', 'email' => 'test2@example.com', 'password' => Hash::make('password')]);

    $team->addMember($user);
    $team->addMember($userTwo);

    expect($team->members->pluck('id'))
        ->toHaveCount(2)
        ->toContain($user->id, $userTwo->id);

    $team->removeMember($user, true);

    expect($team->members->pluck('id'))
        ->toHaveCount(1)
        ->toContain($userTwo->id);

    $team->removeMember($userTwo, true);

    expect($team->members)->toHaveCount(0);
});

