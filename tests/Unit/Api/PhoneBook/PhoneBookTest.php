<?php

namespace Tests\Unit\Api\PhoneBook;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PhoneBookTest extends TestCase
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

        $response = $this->postJson('/api/v1/auth/login', [
            'email' => 'admin@phone-book.local',
            'password' => 'password'
        ], $this->headers);

        $loginResponse = json_decode($response->getContent());
        $this->headers['Authorization'] = 'Bearer ' . $loginResponse->data->access_token;
    }

    public function testCanGetPhoneBookList(): void
    {
        $response = $this->get('/api/v1/phone-books', $this->headers);
        $response->assertStatus(200);

        $responseArray = json_decode($response->getContent(), true);

        $this->assertArrayHasKey('data', $responseArray);
        $this->assertEquals(30, count($responseArray['data']));
    }

    public function testCanGetRequiredFields(): void
    {
        $response = $this->get('/api/v1/phone-books/create', $this->headers);
        $response->assertStatus(200);

        $responseArray = json_decode($response->getContent(), true);

        $this->assertArrayHasKey('data', $responseArray);
        $this->assertEquals(3, count($responseArray['data']));

        $this->assertArrayHasKey('name', $responseArray['data']);
        $this->assertArrayHasKey('telephone', $responseArray['data']);
        $this->assertArrayHasKey('mobile', $responseArray['data']);
    }

    /**
     * Can item add to phone
     */
    public function testCanAddToPhoneBook(): void
    {
        $response = $this->postJson('/api/v1/phone-books', [
            'name' => 'Tau Steven',
            'telephone' => '(098) 76565555',
            'mobile' => '(020) 545 89870'
        ], $this->headers);

        $response->assertStatus(200);

        $responseArray = json_decode($response->getContent(), true);

        $this->assertArrayHasKey('data', $responseArray);
        $this->assertEquals(1, count($responseArray['data']));
        $this->assertArrayHasKey('id', $responseArray['data']);
        $this->assertEquals(31, $responseArray['data']['id']);
    }

    /**
     * Can update in phone book
     */
    public function testCanUpdateToPhoneBook(): void
    {
        $response = $this->putJson('/api/v1/phone-books/2', [
            'name' => 'Tau Steven',
            'telephone' => '(098) 76565555',
            'mobile' => '(020) 545 89870'
        ], $this->headers);

        $response->assertStatus(200);
        $response->assertSeeText('Tau Steven');
        $response->assertSeeText('(098) 76565555');
        $response->assertSeeText('(020) 545 89870');
    }

    /**
     * Can show in phone book by phone book id
     */
    public function testCanShowFromPhoneBook(): void
    {
        $response = $this->get('/api/v1/phone-books/2',  $this->headers);
        $response->assertStatus(200);

        $responseArray = json_decode($response->getContent(), true);

        $this->assertArrayHasKey('data', $responseArray);
        $this->assertEquals(6, count($responseArray['data']));
        $this->assertArrayHasKey('id', $responseArray['data']);
        $this->assertArrayHasKey('name', $responseArray['data']);
        $this->assertArrayHasKey('telephone', $responseArray['data']);
        $this->assertArrayHasKey('mobile', $responseArray['data']);
    }

    /**
     * Can delete item from phone book
     */
    public function testCanDeletePhoneBook(): void
    {
        $response = $this->deleteJson('/api/v1/phone-books/1', [], $this->headers);
        $response->assertStatus(204);
    }
}