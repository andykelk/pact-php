<?php namespace Pact;

interface HttpRequest {
  public function setMethod($method);
  public function setBody($body);
  public function execute();
}

class HttpClient implements HttpRequest {
  private $method;
  private $body;
  private $curlHandle;
  private $options = [];

  function __construct() {
    $this->curlHandle = curl_init();
    $this->setOption(CURLOPT_RETURNTRANSFER, true);
  }

  private function setOption ($name, $value) {
    curl_setopt($this->curlHandle, $name, $value);
    $this->options[$name] = $value;
  }

  public function setUrl ($url) {
    $this->setOption(CURLOPT_URL, $url);
  }

  public function setMethod ($method) {
    if (strtolower($method) == 'get') {
      $this->setOption(CURLOPT_HTTPGET, 1);
      $this->setOption(CURLOPT_HTTPHEADER, ['X-Pact-Mock-Service: true']);
    }
    else {
      if (strtolower($method) == 'put') {
        $this->setOption(CURLOPT_CUSTOMREQUEST, 'PUT');
      }
      else if (strtolower($method) == 'post') {
        $this->setOption(CURLOPT_POST, 1);
      }
      $this->setOption(CURLOPT_HTTPHEADER, ['Content-Type: application/json','X-Pact-Mock-Service: true']);
    }
  }

  public function setBody ($body) {
    $this->setOption(CURLOPT_POSTFIELDS, $body);
  }

  public function execute () {
    return curl_exec($this->curlHandle);
  }
  
  public function getOption ($name) {
    return $this->options[$name];
  }
}
