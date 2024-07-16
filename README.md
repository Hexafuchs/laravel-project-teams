# Provide access to your application on a per-team basis

[![Latest Version on Packagist](https://img.shields.io/packagist/v/hexafuchs/laravel-project-teams.svg?style=flat-square)](https://packagist.org/packages/hexafuchs/laravel-project-teams)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/hexafuchs/laravel-project-teams/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/hexafuchs/laravel-project-teams/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/hexafuchs/laravel-project-teams/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/hexafuchs/laravel-project-teams/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/hexafuchs/laravel-project-teams.svg?style=flat-square)](https://packagist.org/packages/hexafuchs/laravel-project-teams)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer:

```bash
composer require hexafuchs/laravel-project-teams
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="laravel-project-teams-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-project-teams-config"
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="laravel-project-teams-views"
```

## Usage

```php
$team = new Hexafuchs\Team();
echo $team->echoPhrase('Hello, Hexafuchs!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
