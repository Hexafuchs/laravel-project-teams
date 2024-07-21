<?php

namespace Hexafuchs\Team\Commands;

use Illuminate\Console\Command;

class TeamListCommand extends Command
{
    public $signature = 'teams:list';

    public $description = 'List all teams';

    public function handle(): int
    {
        $teams = call_user_func([config('teams.models.team'), 'all']);

        if (count($teams) === 0) {
            $this->error('No teams found');

            return self::FAILURE;
        }

        foreach ($teams as $team) {
            $this->comment('--------------------------');
            $this->comment('Team '.$team['id']);
            $this->comment('Name: '.$team['name']);
            $this->comment('Created: '.$team['created_at']);
            $this->comment('Updated: '.$team['updated_at']);
        }
        $this->comment('--------------------------');

        return self::SUCCESS;
    }
}
