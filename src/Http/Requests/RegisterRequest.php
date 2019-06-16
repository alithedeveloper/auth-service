<?php
declare(strict_types=1);

namespace Diplodocker\Http\Requests;

/**
 * Class RegisterRequest
 * @package Diplodocker\Http\Requests
 */
class RegisterRequest extends AbstractBaseRequest
{
    /**
     * Returns email validation rule
     */
    protected function getEmailValidator(): string
    {
        return sprintf(
            'required|string|unique:%s,%s',
            $this->getDiscoverService()->getTableName(),
            $this->getDiscoverService()->getEmailAttribute()
        );
    }
}
