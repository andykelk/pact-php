<?php namespace Pact;

interface HttpRequest {
  public function setMethod($method);
  public function setBody($body);
  public function execute();
}

class Http implements HttpRequest {
  private $method;
  private $body;
  private $curlHandle;

  function __construct($url) {
    $this->curlHandle = curl_init($url);
    curl_setopt($this->curlHandle, CURLOPT_RETURNTRANSFER, true);
  }

  public function setMethod ($method) {
    if (strtolower($method) == 'get') {
      curl_setopt($this->curlHandle, CURLOPT_HTTPHEADER, ['X-Pact-Mock-Service: true']);
    }
    else {
      if (strtolower($method) == 'put') {
        curl_setopt($this->curlHandle, CURLOPT_CUSTOMREQUEST, 'PUT');
      }
      else if (strtolower($method) == 'post') {
        curl_setopt($this->curlHandle, CURLOPT_POST, 1);
      }
      curl_setopt($this->curlHandle, CURLOPT_HTTPHEADER, ['Content-Type: application/json','X-Pact-Mock-Service: true']);
    }
  }

  public function setBody ($body) {
      curl_setopt($this->curlHandle, CURLOPT_POSTFIELDS, $body);
  }

  public function execute () {
    return curl_exec($this->curlHandle);
  }
}
