<?php
declare(strict_types=1);

namespace Diplodocker\Providers;

use Diplodocker\Services\Contracts\AuthServiceInterface;
use Diplodocker\Services\Contracts\DiscoverServiceInterface;
use Diplodocker\Services\JwtAuthService;
use Diplodocker\Services\UserModelDiscoverService;
use Illuminate\Support\ServiceProvider;

/**
 * Class BindingServiceProvider
 * @package Diplodocker\Providers\BindingServiceProvider
 */
class BindingServiceProvider extends ServiceProvider
{
    /**
     * Bindings
     * @var array
     */
    protected $bindingMap = [
        AuthServiceInterface::class => JwtAuthService::class,
        DiscoverServiceInterface::class => UserModelDiscoverService::class,
    ];

    /**
     * Register maps
     */
    public function register(): void
    {
        $this->registerBindings();
    }

    /**
     * Register bindings
     */
    private function registerBindings(): void
    {
        foreach ($this->bindingMap as $contract => $implementation) {
            $this->app->bind($contract, $implementation);
        }
    }
}
