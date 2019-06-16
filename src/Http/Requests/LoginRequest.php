<?php
declare(strict_types=1);

namespace Diplodocker\Http\Requests;

/**
 * Class LoginRequest
 * @package Diplodocker\Http\Requests
 */
class LoginRequest extends AbstractBaseRequest
{
    /**
     * Returns email validation rule
     */
    protected function getEmailValidator(): string
    {
        return sprintf(
            'required|string|exists:%s,%s',
            $this->getDiscoverService()->getTableName(),
            $this->getDiscoverService()->getEmailAttribute()
        );
    }
}
