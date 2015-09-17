<?php namespace Pact;

class MockServiceRequests {
  static public function putInteractions($interactions, $baseURL) {
    $response = Http::makeRequest('PUT', $baseURL . '/interactions', json_encode(array('interactions' => $interactions)));
    if (!$response) {
      throw new \RuntimeException('Pact interaction setup failed');
    }
  }

  static public function getVerification($baseURL) {
    $response = Http::makeRequest('GET', $baseURL . '/interactions/verification');
    if (!$response) {
      throw new \RuntimeException('Pact verification failed');
    }
  }

  static public function postPact($pactDetails, $baseURL) {
    $response = HTTP::makeRequest('POST', $baseURL . '/pact', json_encode($pactDetails));
    if (!$response) {
      throw new \RuntimeException('Could not write the pact file');
    }
  } 

}
