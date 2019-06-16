<?php
declare(strict_types=1);

namespace Diplodocker\Http\Requests\Constants;

/**
 * Auth constants
 * Interface PasswordValidation
 * @package Diplodocker\Http\Requests\Contracts
 */
interface PasswordValidationRule
{
    /**
     * Min password length
     * @var int
     */
    public const MIN_LENGTH = 3;

    /**
     * Max password length
     * @var int
     */
    public const MAX_LENGTH = 10;
}
