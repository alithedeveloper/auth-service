<?php
declare(strict_types=1);

namespace Diplodocker\Factories;

use Diplodocker\Services\Contracts\AuthorizationInterface as UserModel;
use Diplodocker\Services\Contracts\DiscoverServiceInterface as DiscoverService;

/**
 * Class UserFactory
 * @package Diplodocker\Factories
 */
class UserFactory
{
    /**
     * @var \Diplodocker\Services\Contracts\DiscoverServiceInterface
     */
    private $discoverService;

    /**
     * UserFactory constructor.
     * @param \Diplodocker\Services\Contracts\DiscoverServiceInterface $discoverService
     */
    public function __construct(DiscoverService $discoverService)
    {
        $this->discoverService = $discoverService;
    }

    /**
     * Returns User model instance
     * @param array $data
     */
    public function make(array $data): UserModel
    {
        $model = $this->discoverService->getModelInstance();
        $data['password'] = bcrypt($data['password']);

        return $model->make(
            array_merge(
                $data,
                $model->getFactoryDefaults()
            )
        );
    }
}
