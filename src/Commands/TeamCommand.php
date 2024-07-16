<?php

namespace Hexafuchs\Team\Commands;

use Illuminate\Console\Command;

class TeamCommand extends Command
{
    public $signature = 'laravel-project-teams';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
