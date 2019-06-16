<?php
declare(strict_types=1);

namespace Diplodocker\Http\Controllers\Auth;

use Diplodocker\Http\Controllers\Controller;
use Diplodocker\Services\Contracts\AuthServiceInterface as AuthService;
use Illuminate\Http\JsonResponse;

/**
 * Logout controller
 */
class LogoutController extends Controller
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
     * Returns logout result
     */
    public function handle(): JsonResponse
    {
        return $this->json([
            'success' => $this->authService->logout(),
        ]);
    }
}
