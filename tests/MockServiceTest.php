<?php
 
use Pact\Pact;
 
class MockServiceTest extends PHPUnit_Framework_TestCase {

  public function testGiven() {
    $mockService = Pact::mockService(['port' => 1234, 'consumer' => 'test', 'provider' => 'woo']);
    $this->assertInstanceOf("Pact\Interaction", $mockService->given("an alligator with the name Mary exists"));
  }

  public function testUponReceiving() {
    $mockService = Pact::mockService(['port' => 1234, 'consumer' => 'test', 'provider' => 'woo']);
    $this->assertInstanceOf("Pact\Interaction", $mockService->uponReceiving("a request for an alligator"));
  }

}
