<?php

use Hexafuchs\Team\Team;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('can create a team', function () {
    $name = fake()->company();
    $this->assertDatabaseMissing('teams', [
        'name' => $name,
    ]);

    $this->artisan('teams:create "'.$name.'"')
        ->assertSuccessful();

    $this->assertDatabaseHas('teams', [
        'name' => $name,
    ]);
});

it('can create a team interactively', function () {
    $name = fake()->company();
    $this->assertDatabaseMissing('teams', [
        'name' => $name,
    ]);

    $this->artisan('teams:create')
        ->expectsQuestion('What is the name of the team you want to create?', $name)
        ->assertSuccessful();

    $this->assertDatabaseHas('teams', [
        'name' => $name,
    ]);
});

it('can delete a team', function () {
    $name = fake()->company();
    $team = Team::create(['name' => $name]);

    $this->assertDatabaseHas('teams', [
        'name' => $name,
    ]);

    $this->artisan('teams:remove '.$team->id)
        ->expectsConfirmation('Are you sure you want to delete the team '.$team['name'].' with id '.$team['id'].'?', 'yes')
        ->assertSuccessful();

    $this->assertDatabaseMissing('teams', [
        'name' => $name,
    ]);
});

it('cannot delete a non-existing team', function () {
    $this->assertDatabaseEmpty('teams');

    $this->artisan('teams:remove 0')
        ->expectsOutput('Team not found')
        ->assertFailed();
});

it('can delete a team interactively', function () {
    $name = fake()->company();
    $team = Team::create(['name' => $name]);

    $this->assertDatabaseHas('teams', [
        'name' => $name,
    ]);

    $this->artisan('teams:remove')
        ->expectsQuestion('Which team would you like to delete?', $team['id'].': '.$team['name'])
        ->expectsChoice('Which team would you like to delete?', $team['id'].': '.$team['name'], [$team['id'].': '.$team['name']])
        ->expectsConfirmation('Are you sure you want to delete the team '.$team['name'].' with id '.$team['id'].'?', 'yes')
        ->assertSuccessful();

    $this->assertDatabaseMissing('teams', [
        'name' => $name,
    ]);
});

it('can delete a team in the fallback', function () {
    $name = fake()->company();
    $team = Team::create(['name' => $name]);

    $this->assertDatabaseHas('teams', [
        'name' => $name,
    ]);

    $this->artisan('teams:remove --fallback')
        ->expectsQuestion('Which team would you like to delete?', $team['id'])
        ->expectsQuestion('Which team would you like to delete?', $team['id'])
        ->expectsConfirmation('Are you sure you want to delete the team '.$team['name'].' with id '.$team['id'].'?', 'yes')
        ->assertSuccessful();

    $this->assertDatabaseMissing('teams', [
        'name' => $name,
    ]);
});

it('can abort deleting a team', function () {
    $name = fake()->company();
    $team = Team::create(['name' => $name]);

    $this->assertDatabaseHas('teams', [
        'name' => $name,
    ]);

    $this->artisan('teams:remove '.$team->id)
        ->expectsConfirmation('Are you sure you want to delete the team '.$team['name'].' with id '.$team['id'].'?', 'no')
        ->assertFailed();

    $this->assertDatabaseHas('teams', [
        'name' => $name,
    ]);
});

it('can list all teams', function () {
    $name = fake()->company();
    $nameTwo = fake()->company();
    $team = Team::create(['name' => $name]);
    $teamTwo = Team::create(['name' => $nameTwo]);

    $this->assertDatabaseHas('teams', [
        'name' => $name,
    ]);

    $this->assertDatabaseHas('teams', [
        'name' => $nameTwo,
    ]);

    $this->artisan('teams:list')
        ->expectsOutput('--------------------------')
        ->expectsOutput('Team '.$team['id'])
        ->expectsOutput('Name: '.$team['name'])
        ->expectsOutput('--------------------------')
        ->expectsOutput('Team '.$teamTwo['id'])
        ->expectsOutput('Name: '.$teamTwo['name'])
        ->expectsOutput('--------------------------')
        ->assertSuccessful();
});

it('cannot list no teams', function () {
    $this->assertDatabaseEmpty('teams');

    $this->artisan('teams:list')
        ->expectsOutput('No teams found')
        ->assertFailed();
});
