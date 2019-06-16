<?php

namespace Tests\Feature;

use Diplodocker\Services\Constants\BearerAuthorization;
use Illuminate\Http\Response;
use Tests\TestCase;

class HttpTest extends TestCase
{
    public function testCheckRoute(): void
    {
        $this->assertGuest();
        $response = $this->getJson(
            route('auth-service.check')
        );

        $response->assertSuccessful();
        $response->assertJson([
            'auth' => false
        ]);
    }

    public function testInvalidLoginRoute(): void
    {
        $this->assertGuest();
        // both
        $response = $this->postJson(
            route('auth-service.login', [])
        );
        $response->assertJsonValidationErrors([
            'email',
            'password',
        ]);
        $response->assertStatus(
            Response::HTTP_UNPROCESSABLE_ENTITY
        );

        // email
        $response = $this->postJson(
            route('auth-service.login', [
                'email' => 'test@test.com'
            ])
        );
        $response->assertJsonValidationErrors([
            'password',
        ]);
        $response->assertStatus(
            Response::HTTP_UNPROCESSABLE_ENTITY
        );

        // password
        $response = $this->postJson(
            route('auth-service.login', [
                'password' => 'test@test.com'
            ])
        );
        $response->assertJsonValidationErrors([
            'email',
        ]);
        $response->assertStatus(
            Response::HTTP_UNPROCESSABLE_ENTITY
        );
    }

    public function testInvalidRegisterRoute(): void
    {
        $this->assertGuest();
        // both
        $response = $this->postJson(
            route('auth-service.register', [])
        );
        $response->assertJsonValidationErrors([
            'email',
            'password',
        ]);
        $response->assertStatus(
            Response::HTTP_UNPROCESSABLE_ENTITY
        );

        // email
        $response = $this->postJson(
            route('auth-service.login', [
                'email' => 'test@test.com'
            ])
        );
        $response->assertJsonValidationErrors([
            'password',
        ]);
        $response->assertStatus(
            Response::HTTP_UNPROCESSABLE_ENTITY
        );

        // password
        $response = $this->postJson(
            route('auth-service.login', [
                'password' => 'test@test.com'
            ])
        );
        $response->assertJsonValidationErrors([
            'email',
        ]);
        $response->assertStatus(
            Response::HTTP_UNPROCESSABLE_ENTITY
        );
    }

    public function testValidRegisterRoute(): void
    {
        $email = 'test@test.com';
        $password = 'password';

        $this->assertGuest();

        $response = $this->postJson(
            route('auth-service.register', [
                'email' => $email,
                'password' => $password,
            ])
        );
        $response->assertSuccessful();

        $this->assertDatabaseHas('users', [
            'email' => $email,
        ]);
    }

    public function testFullUserStory()
    {
        $email = 'some@mail.io';
        $password = 'password';

        // registration checks
        $this->assertGuest();
        $response = $this->postJson(
            route('auth-service.register', [
                'email' => $email,
                'password' => $password
            ])
        );
        $response->assertSuccessful();
        $response->assertJsonFragment([
            BearerAuthorization::ATTR_TOKEN_TYPE => BearerAuthorization::TYPE,
            BearerAuthorization::ATTR_EXPIRES_IN => auth()->factory()->getTTL() * 60,
        ]);

        // registered
        $content = $response->decodeResponseJson();
        $token = $content['access_token'];

        $this->assertTrue(isset($content['access_token']) && $content['access_token'] !== '');
        $this->assertIsString($content['access_token']);

        // registered checks
        $response = $this->getJson(
            route('auth-service.check'),
            ['Authorization', "Bearer $token"]
        );
        $response->assertSuccessful();
        $response->assertJson([
            'auth' => true
        ]);

        $this->assertDatabaseHas('users', [
            'email' => $email,
        ]);

        // logout
        $response = $this->getJson(
            route('auth-service.logout'),
            ['Authorization', "Bearer $token"]
        );
        $response->assertSuccessful();
        $response->assertJson([
            'success' => true
        ]);
    }
}
