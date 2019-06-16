<?php
declare(strict_types=1);

namespace Diplodocker\Http\Concerns;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

/**
 * JSON helper for controllers
 */
trait JsonResponsable
{
    /**
     * Return empty response with code
     * @param int $code
     * @param array $headers
     */
    protected function withStatusCode(int $code, array $headers = []): JsonResponse
    {
        return response(null, $code, $headers);
    }

    /**
     * Return JSON response with custom message
     * @param string $message
     * @param int $code
     */
    protected function withError(string $message, int $code = Response::HTTP_UNPROCESSABLE_ENTITY): JsonResponse
    {
        return $this->json(['message' => $message], $code);
    }

    /**
     * Return JSON response
     * @param mixed $response
     * @param int $code
     */
    protected function json($response, int $code = Response::HTTP_OK): JsonResponse
    {
        $code = $response === false ? Response::HTTP_BAD_REQUEST : $code;
        $response = is_bool($response) ? ['success' => $response] : $response;

        return response()->json($response, $code, [], JSON_UNESCAPED_UNICODE);
    }
}
