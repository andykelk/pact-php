<?php namespace Pact;
 
class Pact {

  public static function mockService($args) {
    return new MockService($args);
  } 
}
