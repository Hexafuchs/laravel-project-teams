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
php artisan vendor:publish --tag="project-teams-migrations"
php artisan migrate
```

> [!NOTE]
> If you like, you can make the team names unique. Just add the unique directive to the name column in the migration. 
> You can also add this later, just create a new migration and add the unique condition to the name column.  

You can publish the config file with:

```bash
php artisan vendor:publish --tag="project-teams-config"
```

## Usage

### Getting started

Add the team member trait to your user class, e.g.:

`app\Models\User.php`
```php
use Hexafuchs\Team\Traits\TeamMember;

class User extends Authenticatable
{
    use ..., TeamMember;
}
```

Make sure you published the configuration. Then go into the configuration and update the model class, e.g.:

`config/teams.php`
```php
return [
    'models' => [
        'user' => \App\Models\User::class,
    ]
];

```

### Adding an owned model

To add a model to be owned by your team, add the Ownable trait to it, e.g.:

`app\Models\SomeItem.php`
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Hexafuchs\Team\Traits\Ownable;

class SomeItem extends Model {
    use Ownable;
}
```

### Adding a relation for owned models

If you wanna create a new relation that can be called from the Team model, you should first extend the team model in 
your project, e.g.:

`app\Models\Team.php`
```php
<?php

namespace App\Models;

use Hexafuchs\Team\Team as Model;

class Team extends Model {

}
```

Update the config file to use your newly created model, e.g.:
```php
return [
    'models' => [
        'team' => \App\Models\Team::class,
    ]
];

```

Now add your relation, e.g.:
```php
class Team extends Model {
    public function ownedItems(): MorphToMany
    {
        return $this->morphedByMany(\App\Models\SomeItem, 'ownable');
    }
}
```

## Testing

```bash
composer test
```

## Development

Start setting up workbench if it is not already available under `/workbench`. The more you publish the better. Choose 
the `.env` file.

```bash
php vendor/bin/testbench workbench:install
```

Publish all required resources. (Remember to republish the resources if you change them.)

```bash
php vendor/bin/testbench vendor:publish --tag="project-teams-config"
php vendor/bin/testbench vendor:publish --tag="project-teams-migrations"
```

Let's migrate.

```bash
php vendor/bin/testbench migrate
```

If you wanna execute some command, call `php vendor/bin/testbench` instead of the typical `php artisan`.

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
