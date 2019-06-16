<?php
declare(strict_types=1);

namespace Diplodocker\Http\Requests;

use Diplodocker\Http\Requests\Concerns\ServiceLocator;
use Diplodocker\Http\Requests\Constants\PasswordValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Base request class
 * Class LoginRequest
 * @package Diplodocker\Http\Requests
 */
abstract class AbstractBaseRequest extends FormRequest
{
    use ServiceLocator;

    /**
     * Returns validated data
     */
    public function getCredentials(): array
    {
        return $this->validated();
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'email' => $this->getEmailValidator(),
            'password' => $this->getPasswordValidator(),
        ];
    }

    /**
     * Returns password validation rule
     */
    private function getPasswordValidator(): string
    {
        return sprintf(
            'required|string|min:%d|max:%d',
            PasswordValidationRule::MIN_LENGTH,
            PasswordValidationRule::MAX_LENGTH
        );
    }
}
