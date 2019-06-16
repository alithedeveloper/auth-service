<?php
declare(strict_types=1);

namespace Diplodocker\Services\Constants;

/**
 * Interface BearerAuthorization
 * @package Diplodocker\Services\Constants
 */
interface BearerAuthorization
{
    /**
     * Bearer auth type name
     */
    public const TYPE = 'Bearer';

    /**
     * attr name access_token
     */
    public const ATTR_ACCESS_TOKEN = 'access_token';

    /**
     * attr name token_type
     */
    public const ATTR_TOKEN_TYPE = 'token_type';

    /**
     * attr name expires_in
     */
    public const ATTR_EXPIRES_IN = 'expires_in';
}
