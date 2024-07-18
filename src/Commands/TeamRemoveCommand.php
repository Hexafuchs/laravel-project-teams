<?php

namespace Hexafuchs\Team\Commands;

use Illuminate\Console\Command;
use function Laravel\Prompts\confirm;
use function Laravel\Prompts\search;

class TeamRemoveCommand extends Command
{
    public $signature = 'teams:remove {id? : team id to remove}';

    public $description = 'Delete an existing team';

    /**
     * Returns the chosen team id of an interactive query.
     */
    public function askForTeam(): string
    {
        $teams = call_user_func([config('teams.models.team'), 'all'])->toArray();

        $label = search(
            label: "Which team would you like to delete?",
            options: fn ($search) => array_values(array_filter(
                array_map(fn ($team) => $team['id'] . ': ' . $team['name'], $teams),
                fn ($choice) => str_contains(strtolower($choice), strtolower($search))
            )),
            placeholder: 'Search...',
            scroll: 15,
            required: true,
        );

        return explode(': ', $label)[0];
    }

    public function handle(): int
    {
        $teamId = $this->argument('id') ?
            $this->argument('id') :
            $this->askForTeam();

        $team = call_user_func([config('teams.models.team'), 'find'], $teamId);

        if (empty($team)) {
            $this->error('Team not found');
            return self::FAILURE;
        }

        if (!confirm(
            "Are you sure you want to delete the team " . $team['name'] . " with id " . $team['id'] . "?",
            default: false
        )) {
            return self::FAILURE;
        };

        $team->delete();

        $this->comment('Team deleted successfully.');

        return self::SUCCESS;
    }
}
