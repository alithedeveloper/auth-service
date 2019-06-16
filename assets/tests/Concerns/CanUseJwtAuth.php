<?php
declare(strict_types=1);

namespace Tests\Concerns;

use Diplodocker\Services\Contracts\AuthorizationInterface as UserModel;
use Tymon\JWTAuth\Facades\JWTAuth;

/**
 * Use this trick to login user in tests ;)
 * Trait CanUseJwtAuth
 * @package Tests\Concerns
 */
trait CanUseJwtAuth
{
    /**
     * Add JWT token header
     *
     * @param UserModel $user
     * @return $this
     */
    protected function actingAsJwt(UserModel $user)
    {
        $token = JWTAuth::fromUser($user);

        return $this->withHeader('Authorization', "Bearer $token");
    }
}
