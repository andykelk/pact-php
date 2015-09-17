<?php
 
use Pact\Pact;
 
class MockServiceParameterTest extends PHPUnit_Framework_TestCase {
  /**
   * @expectedException InvalidArgumentException
   */
  public function testNoArguments() {
    Pact::mockService([]);
  }

  /**
   * @expectedException InvalidArgumentException
   */
  public function testMissingPort() {
    Pact::mockService(['consumer' => 'test', 'provider' => 'woo']);
  }

  /**
   * @expectedException InvalidArgumentException
   */
  public function testMissingProvider() {
    Pact::mockService(['port' => 1234, 'consumer' => 'test']);
  }

  /**
   * @expectedException InvalidArgumentException
   */
  public function testMissingConsumer() {
    Pact::mockService(['port' => 1234, 'provider' => 'woo']);
  }

  public function testCreateMockService() {
    $mockService = Pact::mockService(['port' => 1234, 'consumer' => 'test', 'provider' => 'woo']);
    $this->assertInstanceOf("Pact\MockService", $mockService);
  } 

}
