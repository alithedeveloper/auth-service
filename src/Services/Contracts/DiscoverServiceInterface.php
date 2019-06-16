<?php
declare(strict_types=1);

namespace Diplodocker\Services\Contracts;

use Diplodocker\Services\Contracts\AuthorizationInterface as UserModel;

/**
 * Interface DiscoverServiceInterface
 * @package Diplodocker\Services\Contracts
 */
interface DiscoverServiceInterface
{
    /**
     * Must return User class name with namespace
     */
    public function getModelName(): string;

    /**
     * Must return User instance
     */
    public function getModelInstance(): UserModel;

    /**
     * Must return User table name
     */
    public function getTableName(): string;

    /**
     * Must return User email column name
     */
    public function getEmailAttribute(): string;
}
