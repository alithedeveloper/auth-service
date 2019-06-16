<?php
declare(strict_types=1);

namespace Diplodocker\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Package service provider
 * Class AuthProvider
 * @package Diplodocker
 */
class AuthServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap service
     */
    public function boot(): void
    {
        $this->bootAuthRoutes();
    }

    /**
     * Register new authorization routes
     */
    private function bootAuthRoutes(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/auth.php');
    }
}
