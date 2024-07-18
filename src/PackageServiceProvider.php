<?php

namespace Hexafuchs\Team;

use Hexafuchs\Team\Commands\TeamCreateCommand;
use Hexafuchs\Team\Commands\TeamListCommand;
use Hexafuchs\Team\Commands\TeamRemoveCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider as ServiceProvider;

class PackageServiceProvider extends ServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-project-teams')
            ->hasConfigFile('teams')
            ->hasViews()
            ->hasMigration('create_teams_table')
            ->hasCommands([TeamCreateCommand::class, TeamListCommand::class, TeamRemoveCommand::class]);
    }
}
