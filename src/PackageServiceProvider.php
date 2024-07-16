<?php

namespace Hexafuchs\Team;

use Hexafuchs\Team\Commands\TeamCommand;
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
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel_project_teams_table')
            ->hasCommand(TeamCommand::class);
    }
}
