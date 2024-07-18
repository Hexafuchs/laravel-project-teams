<?php

namespace Hexafuchs\Team\Commands;

use Illuminate\Console\Command;

class TeamCreateCommand extends Command
{
    public $signature = 'teams:create {name? : name of the new team}';

    public $description = 'Create a new team';

    public function handle(): int
    {
        $name = $this->argument('name') ?? $this->ask('What is the name of the team you want to create?');

        $team = call_user_func([config('teams.models.team'), 'create'], [ 'name' => $name ]);

        $this->comment('Team ' . $team['name'] . ' created successfully with id ' . $team['id']);

        return self::SUCCESS;
    }
}
