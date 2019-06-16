<?php
declare(strict_types=1);

namespace Diplodocker\Services;

use Diplodocker\Services\Contracts\AuthorizationInterface as UserModel;
use Diplodocker\Services\Contracts\DiscoverServiceInterface;

/**
 * Will find and return User application model
 * Class UserModelDiscoverService
 * @package Diplodocker\Services
 */
class UserModelDiscoverService implements DiscoverServiceInterface
{
    /**
     * @var UserModel
     */
    private $user;

    /**
     * UserModelDiscoverService constructor.
     * @param UserModel $user
     */
    public function __construct(UserModel $user)
    {
        $this->user = $user;
    }

    /**
     * Return User Model
     */
    public function getModelInstance(): UserModel
    {
        return new $this->user;
    }

    /**
     *  Return User model class name with namespace
     */
    public function getModelName(): string
    {
        return (string) get_class($this->user);
    }

    /**
     * Return User table name
     */
    public function getTableName(): string
    {
        return constant($this->getModelName() . '::TABLE_NAME');
    }

    /**
     * Return email column name
     */
    public function getEmailAttribute(): string
    {
        return constant($this->getModelName() . '::ATTR_EMAIL');
    }
}
