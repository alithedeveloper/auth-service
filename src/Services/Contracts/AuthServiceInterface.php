<?php
declare(strict_types=1);

namespace Diplodocker\Services\Contracts;

use Diplodocker\Http\Requests\LoginRequest;
use Diplodocker\Http\Requests\RegisterRequest;

/**
 * Interface AuthServiceInterface
 * @package Diplodocker\Services\Contracts
 */
interface AuthServiceInterface
{
    /**
     * Must login in user
     * @param \Diplodocker\Http\Requests\LoginRequest $request
     */
    public function login(LoginRequest $request): array;

    /**
     * Must logout user
     */
    public function logout(): bool;

    /**
     * @param \Diplodocker\Http\Requests\RegisterRequest $request
     */
    public function register(RegisterRequest $request): array;

    /**
     * Must return auth check result
     */
    public function check(): bool;
}
