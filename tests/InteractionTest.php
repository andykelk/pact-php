<?php

use Pact\Interaction;

class InteractionTest extends PHPUnit\Framework\TestCase
{
    public function testGiven(): void
    {
        $interaction = new Interaction();
        $result = $interaction->given("A nose is on your face");
        $this->assertInstanceOf('Pact\Interaction', $result);
        $this->assertJsonStringEqualsJsonString('{"providerState": "A nose is on your face", "request": [], "response": [], "description": null}', json_encode($interaction));
    }

    public function testUponReceiving(): void
    {
        $interaction = new Interaction();
        $result = $interaction->uponReceiving("A request to show me the money");
        $this->assertInstanceOf('Pact\Interaction', $result);
        $this->assertJsonStringEqualsJsonString('{"providerState": null, "request": [], "response": [], "description": "A request to show me the money"}', json_encode($interaction));
    }

    public function testWithRequestString(): void
    {
        $interaction = new Interaction();
        $result = $interaction->withRequest('GET', '/blah');
        $this->assertInstanceOf('Pact\Interaction', $result);
        $this->assertJsonStringEqualsJsonString('{"providerState": null, "request": {"method": "get", "path": "/blah"}, "response": [], "description": null}', json_encode($interaction));
    }

    public function testWithRequestArray(): void
    {
        $interaction = new Interaction();
        $result = $interaction->withRequest(['method' => 'PUT', 'path' => '/blah']);
        $this->assertInstanceOf('Pact\Interaction', $result);
        $this->assertJsonStringEqualsJsonString('{"providerState": null, "request": {"method": "put", "path": "/blah"}, "response": [], "description": null}', json_encode($interaction));
    }

    public function testWithRequestNoMethod(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $interaction = new Interaction();
        $interaction->withRequest(['path' => '/blah']);
    }

    public function testWithRequestNoPath(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $interaction = new Interaction();
        $interaction->withRequest(['method' => 'POST']);
    }

    public function testWithRequestFullArray(): void
    {
        $interaction = new Interaction();
        $result = $interaction->withRequest(['method' => 'PUT', 'path' => '/blah', 'headers' => ['Accept' => 'application/json'], 'body' => ['message' => 'yahoo']]);
        $this->assertInstanceOf('Pact\Interaction', $result);
        $this->assertJsonStringEqualsJsonString('{"providerState": null, "request": {"method": "put", "path": "/blah", "headers": {"Accept": "application/json"}, "body": {"message": "yahoo"}}, "response": [], "description": null}', json_encode($interaction));
    }

    public function testWithRequestFullArguments(): void
    {
        $interaction = new Interaction();
        $result = $interaction->withRequest('PUT', '/blah', ['Accept' => 'application/json'], ['message' => 'yahoo']);
        $this->assertInstanceOf('Pact\Interaction', $result);
        $this->assertJsonStringEqualsJsonString('{"providerState": null, "request": {"method": "put", "path": "/blah", "headers": {"Accept": "application/json"}, "body": {"message": "yahoo"}}, "response": [], "description": null}', json_encode($interaction));
    }

    public function testWillRespondWithString(): void
    {
        $interaction = new Interaction();
        $result = $interaction->willRespondWith(200);
        $this->assertInstanceOf('Pact\Interaction', $result);
        $this->assertJsonStringEqualsJsonString('{"providerState": null, "request": [], "response": {"status": 200}, "description": null}', json_encode($interaction));
    }

    public function testWillRespondWithArray(): void
    {
        $interaction = new Interaction();
        $result = $interaction->willRespondWith(['status' => 200]);
        $this->assertInstanceOf('Pact\Interaction', $result);
        $this->assertJsonStringEqualsJsonString('{"providerState": null, "request": [], "response": {"status": 200}, "description": null}', json_encode($interaction));
    }

    public function testWillRespondWithNoStatus(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $interaction = new Interaction();
        $interaction->willRespondWith([]);
    }

    public function testWillRespondWithFullArray(): void
    {
        $interaction = new Interaction();
        $result = $interaction->willRespondWith(['status' => 200, 'headers' => ['Content-type' => 'application/json'], 'body' => ['reply' => 'yahoo']]);
        $this->assertInstanceOf('Pact\Interaction', $result);
        $this->assertJsonStringEqualsJsonString('{"providerState": null, "request": [], "response": {"status": 200, "headers": {"Content-type": "application/json"}, "body": {"reply": "yahoo"}}, "description": null}', json_encode($interaction));
    }

    public function testWillRespondWithFullArguments(): void
    {
        $interaction = new Interaction();
        $result = $interaction->willRespondWith(200, ['Content-type' => 'application/json'], ['reply' => 'yahoo']);
        $this->assertInstanceOf('Pact\Interaction', $result);
        $this->assertJsonStringEqualsJsonString('{"providerState": null, "request": [], "response": {"status": 200, "headers": {"Content-type": "application/json"}, "body": {"reply": "yahoo"}}, "description": null}', json_encode($interaction));
    }
}
