<?php
declare(strict_types=1);

namespace Diplodocker\Http\Controllers\Auth;

use Diplodocker\Http\Controllers\Controller;
use Diplodocker\Services\Contracts\AuthServiceInterface as AuthService;
use Illuminate\Http\JsonResponse;

/**
 * Check authorization controller
 */
class CheckController extends Controller
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
     * Returns check auth result
     */
    public function handle(): JsonResponse
    {
        return $this->json([
            'auth' => $this->authService->check(),
        ]);
    }
}
