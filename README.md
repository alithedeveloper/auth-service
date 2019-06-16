### About

[![Build Status](https://travis-ci.org/diplodocker/auth-service.svg?branch=master)](https://travis-ci.org/diplodocker/auth-service)
[![GitHub issues](https://img.shields.io/github/issues/diplodocker/auth-service.svg)](https://github.com/diplodocker/auth-service/issues)
[![Made for Laravel](https://img.shields.io/badge/made%20for-laravel-orange.svg?style=flat&logo=Laravel)](https://laravel.com/)


Laravel JWT auth service package this is just a wrapper over a `tymon/jwt-auth` package that includes services, controllers and a factory.

### Install

```
composer require diplodocker/auth-service
```

### Configure `User` model
* Implement `Diplodocker\Services\Contracts\AuthorizationInterface`
* Use `Diplodocker\Services\Concerns\CanUseAuthorizationTokens` (or implement methods from trait)
* Add `TABLE_NAME` and `ATTR_EMAIL` constants to `User` model

```php
<?php
declare(strict_types=1);

namespace App\Models;

use Diplodocker\Services\Concerns\CanUseAuthorizationTokens;
use Diplodocker\Services\Contracts\AuthorizationInterface;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements AuthorizationInterface
{
    // ...
    use CanUseAuthorizationTokens;

    public const TABLE_NAME = 'users';
    public const ATTR_EMAIL = 'email';

    // ...
}
```
### Bind interface

* Open (or create) `AppServiceProvider` or `BindServiceProvider`
* Bind interface to the model in `boot` method

Example:

```php
<?php
declare(strict_types=1);

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Diplodocker\Services\Contracts\AuthorizationInterface;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->bind(
            AuthorizationInterface::class,
            User::class
        );
    }
}
```

### Configure `auth` config

```diff
'defaults' => [
+    'guard' => 'api',
],
```

```diff
'guards' => [
    'api' => [
+       'driver' => 'jwt',
        ...
    ],
],
```

### Run command

```
php artisan jwt:secret
```

### Routes

| Method | URI | Route| Required params|
|--|--|--|--|
| `GET`| `auth/check`    | `auth-service.check`    | none |
| `POST`| `auth/login`    | `auth-service.login`    | `email`, `password` |
| `GET`| `auth/logout`   | `auth-service.logout`   | none |
| `POST`| `auth/register` | `auth-service.register` | `email`, `password` |
