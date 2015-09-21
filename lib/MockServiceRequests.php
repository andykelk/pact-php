<?php namespace Pact;

class MockServiceRequests {
  private $httpClient;

  function __construct($httpClient = null) {
    $this->httpClient = is_null($httpClient) ? new HttpClient() : $httpClient;
  }
  
  public function putInteractions($interactions, $baseURL) {
    $this->httpClient->setUrl($baseURL . '/interactions');
    $this->httpClient->setMethod('PUT');
    $this->httpClient->setBody(json_encode(['interactions' => $interactions]));
    $response = $this->httpClient->execute();
    if (!$response) {
      throw new \RuntimeException('Pact interaction setup failed');
    }
  }

  public function getVerification($baseURL) {
    $this->httpClient->setUrl($baseURL . '/interactions/verification');
    $this->httpClient->setMethod('GET');
    $response = $this->httpClient->execute();
    if (!$response) {
      throw new \RuntimeException('Pact verification failed');
    }
  }

  public function postPact($pactDetails, $baseURL) {
    $this->httpClient->setUrl($baseURL . '/pact');
    $this->httpClient->setMethod('POST');
    $this->httpClient->setBody(json_encode($pactDetails));
    $response = $this->httpClient->execute();
    if (!$response) {
      throw new \RuntimeException('Could not write the pact file');
    }
  } 
}
