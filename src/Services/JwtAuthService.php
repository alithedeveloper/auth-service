<?php
declare(strict_types=1);

namespace Diplodocker\Services;

use Diplodocker\Exceptions\RegistrationException;
use Diplodocker\Factories\UserFactory;
use Diplodocker\Http\Requests\LoginRequest;
use Diplodocker\Http\Requests\RegisterRequest;
use Diplodocker\Services\Constants\BearerAuthorization;
use Diplodocker\Services\Contracts\AuthServiceInterface;
use Illuminate\Auth\Access\AuthorizationException;

/**
 * JWT Authorization service
 * Class JwtAuthService
 * @package Diplodocker\Services
 */
class JwtAuthService implements AuthServiceInterface
{
    private $guard;

    /**
     * @var \Diplodocker\Factories\UserFactory
     */
    private $userFactory;

    /**
     * AuthService constructor.
     * @param \Diplodocker\Factories\UserFactory $userFactory
     */
    public function __construct(UserFactory $userFactory)
    {
        $this->guard = auth();
        $this->userFactory = $userFactory;
    }

    /**
     * Login action
     * @param \Diplodocker\Http\Requests\LoginRequest $request
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @return array
     */
    public function login(LoginRequest $request): array
    {
        $credentials = $request->getCredentials();

        if ($token = $this->guard->attempt($credentials)) {
            return $this->createTokenResponse($token);
        }

        throw new AuthorizationException;
    }

    /**
     * Returns response array to controller
     * @param $token
     */
    private function createTokenResponse($token): array
    {
        return [
            BearerAuthorization::ATTR_ACCESS_TOKEN => $token,
            BearerAuthorization::ATTR_TOKEN_TYPE => BearerAuthorization::TYPE,
            BearerAuthorization::ATTR_EXPIRES_IN => $this->guard->factory()->getTTL() * 60,
        ];
    }

    /**
     * Logout action
     */
    public function logout(): bool
    {
        $this->guard->logout();

        return !$this->check();
    }

    /**
     * Register action
     * @param \Diplodocker\Http\Requests\RegisterRequest $request
     * @throws \Diplodocker\Exceptions\RegistrationException
     * @throws \Throwable
     */
    public function register(RegisterRequest $request): array
    {
        $userAsset = $this->userFactory->make(
            $request->getCredentials()
        );
        $user = tap($userAsset)->save();

        throw_unless((bool) $user, RegistrationException::class);

        if ($token = $this->guard->login($user)) {
            return $this->createTokenResponse($token);
        }

        throw new RegistrationException;
    }

    /**
     * Returns auth result
     * @return bool
     */
    public function check(): bool
    {
        return $this->guard->check();
    }
}
