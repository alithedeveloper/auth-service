<?php
declare(strict_types=1);

namespace Diplodocker\Http\Requests\Concerns;

use Diplodocker\Services\Contracts\DiscoverServiceInterface as DiscoverService;

/**
 * Trait ServiceLocator
 * @package Diplodocker\Http\Requests\Concerns
 */
trait ServiceLocator
{
    /**
     * @var \Diplodocker\Services\Contracts\DiscoverServiceInterface
     */
    private $discoverService;

    /**
     * ServiceLocator constructor.
     * @param \Diplodocker\Services\Contracts\DiscoverServiceInterface $discoverService
     */
    public function __construct(DiscoverService $discoverService)
    {
        $this->discoverService = $discoverService;
    }

    /**
     * Returns discover service
     */
    public function getDiscoverService(): DiscoverService
    {
        return $this->discoverService;
    }
}
