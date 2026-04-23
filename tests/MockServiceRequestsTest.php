<?php

use Pact\MockServiceRequests;
use Pact\Interaction;
use Pact\HttpClient;

class MockServiceRequestsTest extends PHPUnit\Framework\TestCase
{
    public function testPutInteractions(): void
    {
        $http = $this->createMock(HttpClient::class);
        $http->expects($this->once())->method('execute')->willReturn(true);
        $mockServiceRequests = new MockServiceRequests($http);
        $interaction = new Interaction();
        $mockServiceRequests->putInteractions([$interaction], 'http://127.0.0.1');
    }

    public function testPutInteractionFailure(): void
    {
        $this->expectException(\RuntimeException::class);
        $http = $this->createMock(HttpClient::class);
        $http->method('execute')->willReturn(false);
        $mockServiceRequests = new MockServiceRequests($http);
        $interaction = new Interaction();
        $mockServiceRequests->putInteractions([$interaction], 'http://127.0.0.1');
    }

    public function testGetVerification(): void
    {
        $http = $this->createMock(HttpClient::class);
        $http->expects($this->once())->method('execute')->willReturn(true);
        $mockServiceRequests = new MockServiceRequests($http);
        $mockServiceRequests->getVerification('http://127.0.0.1');
    }

    public function testGetVerificationFailure(): void
    {
        $this->expectException(\RuntimeException::class);
        $http = $this->createMock(HttpClient::class);
        $http->method('execute')->willReturn(false);
        $mockServiceRequests = new MockServiceRequests($http);
        $mockServiceRequests->getVerification('http://127.0.0.1');
    }

    public function testPostPact(): void
    {
        $http = $this->createMock(HttpClient::class);
        $http->expects($this->once())->method('execute')->willReturn(true);
        $mockServiceRequests = new MockServiceRequests($http);
        $pactDetails = ['consumer' => ['name' => 'c'], 'provider' => ['name' => 'p']];
        $mockServiceRequests->postPact($pactDetails, 'http://127.0.0.1');
    }

    public function testPostPactFailure(): void
    {
        $this->expectException(\RuntimeException::class);
        $http = $this->createMock(HttpClient::class);
        $http->method('execute')->willReturn(false);
        $mockServiceRequests = new MockServiceRequests($http);
        $pactDetails = ['consumer' => ['name' => 'c'], 'provider' => ['name' => 'p']];
        $mockServiceRequests->postPact($pactDetails, 'http://127.0.0.1');
    }
}
