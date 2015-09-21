<?php
 
use Pact\Http;
 
class HttpTest extends PHPUnit_Framework_TestCase {
  public function testConstructor () {
    $http = new Http('http://127.0.0.1');
    $this->assertInstanceOf('Pact\Http', $http);
    $this->assertEquals('http://127.0.0.1', $http->getUrl());
  }

  /**
   * @expectedException InvalidArgumentException
   */
  public function testConstructorNoUrl () {
    PHPUnit_Framework_Error_Warning::$enabled = FALSE;
    $http = new Http('');
  }

  public function testHeaderIsSet () {
    $http = new Http('http://127.0.0.1');
    $http->setMethod('GET');
    $this->assertContains('X-Pact-Mock-Service: true', $http->getOption(CURLOPT_HTTPHEADER));
    $http = new Http('http://127.0.0.1');
    $http->setMethod('PUT');
    $this->assertContains('X-Pact-Mock-Service: true', $http->getOption(CURLOPT_HTTPHEADER));
    $http = new Http('http://127.0.0.1');
    $http->setMethod('POST');
    $this->assertContains('X-Pact-Mock-Service: true', $http->getOption(CURLOPT_HTTPHEADER));
  }
  
  public function testMethodPut () {
    $http = new Http('http://127.0.0.1');
    $http->setMethod('PUT');
    $this->assertEquals('PUT', $http->getOption(CURLOPT_CUSTOMREQUEST));
    $this->assertContains('Content-Type: application/json', $http->getOption(CURLOPT_HTTPHEADER));
  }

  public function testMethodPost () {
    $http = new Http('http://127.0.0.1');
    $http->setMethod('POST');
    $this->assertEquals(1, $http->getOption(CURLOPT_POST));
    $this->assertContains('Content-Type: application/json', $http->getOption(CURLOPT_HTTPHEADER));
  }

  public function testSetBody () {
    $http = new Http('http://127.0.0.1');
    $http->setBody('{"test": true}');
    $this->assertEquals('{"test": true}', $http->getOption(CURLOPT_POSTFIELDS));
  }
}