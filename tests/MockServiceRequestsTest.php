<?php
 
use Pact\MockServiceRequests;
use Pact\Interaction;
 
class MockServiceRequestsTest extends PHPUnit_Framework_TestCase {
  public function testPutInteractions () {
    $http = Phockito::spy('Pact\HttpClient');
    Phockito::when($http)->execute()->return(true);
    $mockServiceRequests = new MockServiceRequests($http);
    $interaction = new Interaction();
    $mockServiceRequests->putInteractions([$interaction], 'http://127.0.0.1');
    Phockito::verify($http)->execute(); 
  }

  /**
   * @expectedException RuntimeException
   */
  public function testPutInteractionFailure () {
    $http = Phockito::spy('Pact\HttpClient');
    Phockito::when($http)->execute()->return(false);
    $mockServiceRequests = new MockServiceRequests($http);
    $interaction = new Interaction();
    $mockServiceRequests->putInteractions([$interaction], 'http://127.0.0.1');
  }

  public function testGetVerification () {
    $http = Phockito::spy('Pact\HttpClient');
    Phockito::when($http)->execute()->return(true);
    $mockServiceRequests = new MockServiceRequests($http);
    $mockServiceRequests->getVerification('http://127.0.0.1');
    Phockito::verify($http)->execute(); 
  }

  /**
   * @expectedException RuntimeException
   */
  public function testGetVerificationFailure () {
    $http = Phockito::spy('Pact\HttpClient');
    Phockito::when($http)->execute()->return(false);
    $mockServiceRequests = new MockServiceRequests($http);
    $mockServiceRequests->getVerification('http://127.0.0.1');
  }

  public function testPostPact () {
    $http = Phockito::spy('Pact\HttpClient');
    Phockito::when($http)->execute()->return(true);
    $mockServiceRequests = new MockServiceRequests($http);
    $pactDetails = ['consumer' => ['name' => 'c'], 'provider' => ['name' => 'p']];
    $mockServiceRequests->postPact($pactDetails, 'http://127.0.0.1');
    Phockito::verify($http)->execute(); 
  }

  /**
   * @expectedException RuntimeException
   */
  public function testPostPactFailure () {
    $http = Phockito::spy('Pact\HttpClient');
    Phockito::when($http)->execute()->return(false);
    $mockServiceRequests = new MockServiceRequests($http);
    $pactDetails = ['consumer' => ['name' => 'c'], 'provider' => ['name' => 'p']];
    $mockServiceRequests->postPact($pactDetails, 'http://127.0.0.1');
  }
}
