<?php
declare(strict_types=1);

namespace Diplodocker\Http\Controllers\Auth;

use Diplodocker\Http\Controllers\Controller;
use Diplodocker\Http\Requests\RegisterRequest;
use Diplodocker\Services\Contracts\AuthServiceInterface as AuthService;
use Illuminate\Http\JsonResponse;

/**
 * Register controller
 */
class RegisterController extends Controller
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
     * Register User
     * @param \Diplodocker\Http\Requests\RegisterRequest $request
     */
    public function handle(RegisterRequest $request): JsonResponse
    {
        return $this->json(
            $this->authService->register($request)
        );
    }
}
