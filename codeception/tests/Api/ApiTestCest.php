<?php

namespace Tests\Api;

use Tests\Support\ApiTester;

class ApiTestCest
{
    public function testGetSuccess(ApiTester $I): void
    {
        $I->sendGet('/posts/1');

        $expectedStatusCode = 200;
        $expectedContent = [
            "id" => 1,
            "title" => "json-server",
            "author" => "typicode"
        ];

        $I->seeResponseCodeIs($expectedStatusCode);
        $I->seeResponseContainsJson($expectedContent);
    }

    public function testGetFailed(ApiTester $I): void
    {
        $I->sendGet('/posts/10000');

        $expectedStatusCode = 404;
        $expectedContent = [];

        $I->seeResponseCodeIs($expectedStatusCode);
        $I->seeResponseContainsJson($expectedContent);
    }

    public function testPostSuccess(ApiTester $I): void
    {
        $I->sendPost('/posts', [
            "title" => "json-server 2", 
            "author" => "typicode"
        ]);

        $expectedStatusCode = 201;
        $expectedContent = [
            "title" => "json-server 2"
        ];

        $I->seeResponseCodeIs($expectedStatusCode);
        $I->seeResponseContainsJson($expectedContent);
    }
}
