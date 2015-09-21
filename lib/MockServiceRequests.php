<?php namespace Pact;

class MockServiceRequests {
  static public function putInteractions($interactions, $baseURL) {
    $http = new Http($baseURL . '/interactions');
    $http->setMethod('PUT');
    $http->setBody(json_encode(['interactions' => $interactions]));
    $response = $http->execute();
    if (!$response) {
      throw new \RuntimeException('Pact interaction setup failed');
    }
  }

  static public function getVerification($baseURL) {
    $http = new Http($baseURL . '/interactions/verification');
    $http->setMethod('GET');
    $response = $http->execute();
    if (!$response) {
      throw new \RuntimeException('Pact verification failed');
    }
  }

  static public function postPact($pactDetails, $baseURL) {
    $http = new Http($baseURL . '/pact');
    $http->setMethod('POST');
    $http->setBody(json_encode($pactDetails));
    $response = $http->execute();
    if (!$response) {
      throw new \RuntimeException('Could not write the pact file');
    }
  } 
}
