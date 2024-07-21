PackageTest.php<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;

uses(RefreshDatabase::class);

beforeEach(function () {
    Config::set('teams.models.user', Workbench\App\Models\User::class);
    $this->loadMigrationsFrom(__DIR__.'/../workbench/database/migrations');
});

it('can add teams to ownables', function () {
    $team = \Workbench\App\Models\Team::create(['name' => 'Team 1']);
    $teamTwo = \Workbench\App\Models\Team::create(['name' => 'Team 2']);

    $item = \Workbench\App\Models\SomeItem::create();
    $item->addTeam($team);
    $item->addTeam($teamTwo);

    expect($item->owners->pluck('id'))
        ->toHaveCount(2)
        ->toContain($team->id, $teamTwo->id);
});

it('can remove teams from ownables', function () {
    $team = \Workbench\App\Models\Team::create(['name' => 'Team 1']);
    $teamTwo = \Workbench\App\Models\Team::create(['name' => 'Team 2']);

    $item = \Workbench\App\Models\SomeItem::create();
    $item->addTeam($team);
    $item->addTeam($teamTwo);

    expect($item->owners->pluck('id'))
        ->toHaveCount(2)
        ->toContain($team->id, $teamTwo->id);

    $item->removeTeam($team);

    expect($item->owners->pluck('id'))
        ->toHaveCount(1)
        ->toContain($teamTwo->id);

    $item->removeTeam($teamTwo);

    expect($item->owners)->toHaveCount(0);
});

it('can check if ownable belongs to team', function () {
    $team = \Workbench\App\Models\Team::create(['name' => 'Team 1']);
    $teamTwo = \Workbench\App\Models\Team::create(['name' => 'Team 2']);

    $item = \Workbench\App\Models\SomeItem::create();
    $item->addTeam($team);

    expect($item->isOwnedBy($team))->toBeTrue()
        ->and($item->isOwnedBy($teamTwo))->toBeFalse();
});
