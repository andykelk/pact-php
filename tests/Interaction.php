<?php
 
use Pact\Interaction;
 
class InteractionTest extends PHPUnit_Framework_TestCase {
  public function testGiven () {
    $interaction = new Interaction();
    $result = $interaction->given("A nose is on your face");
    $this->assertInstanceOf('Pact\Interaction', $result);
    $this->assertJsonStringEqualsJsonString('{"providerState": "A nose is on your face", "request": [], "response": [], "description": null}', json_encode($interaction));
  } 
 
  public function testUponReceiving () {
    $interaction = new Interaction();
    $result = $interaction->uponReceiving("A request to show me the money");
    $this->assertInstanceOf('Pact\Interaction', $result);
    $this->assertJsonStringEqualsJsonString('{"providerState": null, "request": [], "response": [], "description": "A request to show me the money"}', json_encode($interaction));
  }
  
  public function testWithRequestString () {
    $interaction = new Interaction();
    $result = $interaction->withRequest('GET', '/blah');
    $this->assertInstanceOf('Pact\Interaction', $result);
    $this->assertJsonStringEqualsJsonString('{"providerState": null, "request": {"method": "get", "path": "/blah"}, "response": [], "description": null}', json_encode($interaction));
  }
 
  public function testWithRequestArray () {
    $interaction = new Interaction();
    $result = $interaction->withRequest(['method' => 'PUT', 'path' => '/blah']);
    $this->assertInstanceOf('Pact\Interaction', $result);
    $this->assertJsonStringEqualsJsonString('{"providerState": null, "request": {"method": "put", "path": "/blah"}, "response": [], "description": null}', json_encode($interaction));
  }

  /**
   * @expectedException InvalidArgumentException
   */
  public function testWithRequestNoMethod () {
    $interaction = new Interaction();
    $result = $interaction->withRequest(['path' => '/blah']);
  }
 
  /**
   * @expectedException InvalidArgumentException
   */
  public function testWithRequestNoPath () {
    $interaction = new Interaction();
    $result = $interaction->withRequest(['method' => 'POST']);
  }
 
  public function testWithRequestFullArray () {
    $interaction = new Interaction();
    $result = $interaction->withRequest(['method' => 'PUT', 'path' => '/blah', 'headers' => ['Accept' => 'application/json'], 'body' => ['message' => 'yahoo']]);
    $this->assertInstanceOf('Pact\Interaction', $result);
    $this->assertJsonStringEqualsJsonString('{"providerState": null, "request": {"method": "put", "path": "/blah", "headers": {"Accept": "application/json"}, "body": {"message": "yahoo"}}, "response": [], "description": null}', json_encode($interaction));
  }

  public function testWithRequestFullArguments () {
    $interaction = new Interaction();
    $result = $interaction->withRequest('PUT', '/blah', ['Accept' => 'application/json'], ['message' => 'yahoo']);
    $this->assertInstanceOf('Pact\Interaction', $result);
    $this->assertJsonStringEqualsJsonString('{"providerState": null, "request": {"method": "put", "path": "/blah", "headers": {"Accept": "application/json"}, "body": {"message": "yahoo"}}, "response": [], "description": null}', json_encode($interaction));
  }

  public function testWillRespondWithString () {
    $interaction = new Interaction();
    $result = $interaction->willRespondWith(200);
    $this->assertInstanceOf('Pact\Interaction', $result);
    $this->assertJsonStringEqualsJsonString('{"providerState": null, "request": [], "response": {"status": 200}, "description": null}', json_encode($interaction));
  }
 
  public function testWillRespondWithArray () {
    $interaction = new Interaction();
    $result = $interaction->willRespondWith(['status' => 200]);
    $this->assertInstanceOf('Pact\Interaction', $result);
    $this->assertJsonStringEqualsJsonString('{"providerState": null, "request": [], "response": {"status": 200}, "description": null}', json_encode($interaction));
  }

  /**
   * @expectedException InvalidArgumentException
   */
  public function testWillRespondWithNoStatus () {
    $interaction = new Interaction();
    $result = $interaction->willRespondWith([]);
  }
 
  public function testWillRespondWithFullArray () {
    $interaction = new Interaction();
    $result = $interaction->willRespondWith(['status' => 200, 'headers' => ['Content-type' => 'application/json'], 'body' => ['reply' => 'yahoo']]);
    $this->assertInstanceOf('Pact\Interaction', $result);
    $this->assertJsonStringEqualsJsonString('{"providerState": null, "request": [], "response": {"status": 200, "headers": {"Content-type": "application/json"}, "body": {"reply": "yahoo"}}, "description": null}', json_encode($interaction));
  }

  public function testWillRespondWithFullArguments () {
    $interaction = new Interaction();
    $result = $interaction->willRespondWith(200, ['Content-type' => 'application/json'], ['reply' => 'yahoo']);
    $this->assertInstanceOf('Pact\Interaction', $result);
    $this->assertJsonStringEqualsJsonString('{"providerState": null, "request": [], "response": {"status": 200, "headers": {"Content-type": "application/json"}, "body": {"reply": "yahoo"}}, "description": null}', json_encode($interaction));
  }
}
