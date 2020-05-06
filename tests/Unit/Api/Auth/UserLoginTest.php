<?php

namespace Tests\Unit\Api\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserLoginTest extends TestCase
{
    use RefreshDatabase;

    protected $headers = [
        "Accept" => "application/json",
        "CONTENT_TYPE" => "application/json",
    ];

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('passport:install');
        $this->artisan('db:seed');
    }

    public function testCanUserLogin(): void
    {
        $response = $this->postJson('/api/v1/auth/login', [
            'email' => 'admin@phone-book.local',
            'password' => 'password'
        ], $this->headers);
        $response->assertStatus(200);
    }

    public function testCanUserLogout(): void
    {
        $response = $this->postJson('/api/v1/auth/login', [
            'email' => 'admin@phone-book.local',
            'password' => 'password'
        ], $this->headers);

        $response->assertSeeText('access_token');

        $loginResponse = json_decode($response->getContent());
        $this->headers['Authorization'] ='Bearer ' . $loginResponse->data->access_token;

        $logoutResponse = $this->get('api/v1/auth/logout', $this->headers);

        $logoutResponse->assertStatus(200);
        $logoutResponse->assertSeeText('Successfully logged out');
    }

}
