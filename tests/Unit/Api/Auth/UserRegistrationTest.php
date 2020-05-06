<?php

namespace Tests\Unit\Api\Auth;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class userRegistrationTest extends TestCase
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
    }


    /**
     * Can user enter invalid name
     */
    public function testCanUserEnterInvalidName(): void
    {
        $response = $this->postJson('/api/v1/auth/register', [
            'name' => '&*^ggghh',
            'email' => 'sally@example.com',
            'password' => 'T$hggyy&76g'
        ], $this->headers);

        $response->assertSeeText('The given data was invalid.');
        $response->assertSeeText('The name format is invalid.');
        $response->assertStatus(422);
    }


    /**
     * Can user enter invalid email
     */
    public function testCanUserEnterInvalidEmail(): void
    {
        $response = $this->postJson('/api/v1/auth/register', [
            'name' => '&*^ggghh',
            'email' => 'sally-example.com',
            'password' => 'T$hggyy&76g'
        ], $this->headers);

        $response->assertSeeText('The given data was invalid.');
        $response->assertStatus(422);
    }

    /**
     * Can user Register.
     */
    public function testCanUserRegister(): void
    {
        $response = $this->postJson('/api/v1/auth/register', [
            'name' => 'Sally Kuchakub',
            'email' => 'sally@example.com',
            'password' => 'T$hggyy&76g'
        ], $this->headers);

        $response->assertStatus(200);
    }
}
