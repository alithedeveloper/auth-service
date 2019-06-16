<?php

namespace App;

use Diplodocker\Services\Concerns\CanUseAuthorizationTokens;
use Diplodocker\Services\Contracts\AuthorizationInterface;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements AuthorizationInterface
{
    use Notifiable;
    use CanUseAuthorizationTokens;

    public const TABLE_NAME = 'users';
    public const ATTR_EMAIL = 'email';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * Return default fields
     */
    public function getFactoryDefaults(): array
    {
        return [
            'name' => 'user'
        ];
    }
}
