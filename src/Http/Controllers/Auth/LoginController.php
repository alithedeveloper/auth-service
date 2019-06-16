<?php
declare(strict_types=1);

namespace Diplodocker\Http\Controllers\Auth;

use Diplodocker\Http\Controllers\Controller;
use Diplodocker\Http\Requests\LoginRequest;
use Diplodocker\Services\Contracts\AuthServiceInterface as AuthService;
use Illuminate\Http\JsonResponse;

/**
 * Login controller
 */
class LoginController extends Controller
{
    /**
     * @var \Diplodocker\Services\Contracts\AuthServiceInterface
     */
    private $authService;

    /**
     * CheckController constructor.
     * @param \Diplodocker\Services\Contracts\AuthServiceInterface $authService
     */
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Login User
     * @param \Diplodocker\Http\Requests\LoginRequest $request
     */
    public function handle(LoginRequest $request): JsonResponse
    {
        return $this->json(
            $this->authService->login($request)
        );
    }
}
