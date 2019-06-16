<?php
declare(strict_types=1);

namespace Diplodocker\Services\Contracts;

use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * Interface AuthorizationInterface
 * @package Diplodocker\Services\Contracts
 */
interface AuthorizationInterface extends JWTSubject
{
    /**
     * Must return default columns
     */
    public function getFactoryDefaults(): array;
}
