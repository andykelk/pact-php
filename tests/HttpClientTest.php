<?php

use Pact\HttpClient;

class HttpClientTest extends PHPUnit\Framework\TestCase
{
    public function testConstructor(): void
    {
        $http = new HttpClient();
        $this->assertInstanceOf('Pact\HttpClient', $http);
    }

    public function testSetUrl(): void
    {
        $http = new HttpClient();
        $http->setUrl('http://127.0.0.1');
        $this->assertEquals('http://127.0.0.1', $http->getOption(CURLOPT_URL));
    }

    public function testHeaderIsSet(): void
    {
        $http = new HttpClient();
        $http->setUrl('http://127.0.0.1');
        $http->setMethod('GET');
        $this->assertContains('X-Pact-Mock-Service: true', $http->getOption(CURLOPT_HTTPHEADER));

        $http = new HttpClient();
        $http->setUrl('http://127.0.0.1');
        $http->setMethod('PUT');
        $this->assertContains('X-Pact-Mock-Service: true', $http->getOption(CURLOPT_HTTPHEADER));

        $http = new HttpClient();
        $http->setUrl('http://127.0.0.1');
        $http->setMethod('POST');
        $this->assertContains('X-Pact-Mock-Service: true', $http->getOption(CURLOPT_HTTPHEADER));
    }

    public function testMethodPut(): void
    {
        $http = new HttpClient();
        $http->setUrl('http://127.0.0.1');
        $http->setMethod('PUT');
        $this->assertEquals('PUT', $http->getOption(CURLOPT_CUSTOMREQUEST));
        $this->assertContains('Content-Type: application/json', $http->getOption(CURLOPT_HTTPHEADER));
    }

    public function testMethodPost(): void
    {
        $http = new HttpClient();
        $http->setUrl('http://127.0.0.1');
        $http->setMethod('POST');
        $this->assertEquals(1, $http->getOption(CURLOPT_POST));
        $this->assertContains('Content-Type: application/json', $http->getOption(CURLOPT_HTTPHEADER));
    }

    public function testSetBody(): void
    {
        $http = new HttpClient();
        $http->setUrl('http://127.0.0.1');
        $http->setBody('{"test": true}');
        $this->assertEquals('{"test": true}', $http->getOption(CURLOPT_POSTFIELDS));
    }
}
