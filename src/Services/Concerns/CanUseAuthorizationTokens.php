<?php
declare(strict_types=1);

namespace Diplodocker\Services\Concerns;

/**
 * Trait CanUseAuthorizationTokens
 * @package Diplodocker\Services\Concerns
 */
trait CanUseAuthorizationTokens
{
    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     * @return mixed
     */
    public function getJWTIdentifier(): int
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     */
    public function getJWTCustomClaims(): array
    {
        return [];
    }

    /**
     * Return default fields
     */
    public function getFactoryDefaults(): array
    {
        return [];
    }
}
