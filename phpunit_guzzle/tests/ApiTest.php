<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

use GuzzleHttp\Client;

final class ApiTest extends TestCase
{
    protected Client $client;

    protected function setUp(): void 
    {
        $this->client = new Client([
            'base_uri' => 'http://json_server:3000',
            'http_errors' => false
        ]);
    }

    public function testGetSuccess(): void
    {
        $response = $this->client->get('/posts/1');

        $expectedStatusCode = 200;
        $expectedContent = [
            "id" => 1,
            "title" => "json-server",
            "author" => "typicode"
        ];

        $this->assertEquals($expectedStatusCode, $response->getStatusCode());
        $this->assertEquals($expectedContent, json_decode($response->getBody()->getContents(), true));
    }

    public function testGetFailed(): void
    {
        $response = $this->client->get('/posts/10000');

        $expectedStatusCode = 404;
        $expectedContent = [];

        $this->assertEquals($expectedStatusCode, $response->getStatusCode());
        $this->assertEquals($expectedContent, json_decode($response->getBody()->getContents(), true));
    }

    public function testPostSuccess(): void
    {
        $response = $this->client->post('/posts', [
            'form_params' => [
                "title" => "json-server 2", 
                "author" => "typicode"
            ]
        ]);

        $expectedStatusCode = 201;
        $expectedContent = "json-server 2";

        $this->assertEquals($expectedStatusCode, $response->getStatusCode());
        $this->assertContains(
            $expectedContent, 
            json_decode($response->getBody()->getContents(), true)
        );
    }
}