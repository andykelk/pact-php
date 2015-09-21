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
  private $options = [];
  private $url;

  function __construct($url) {
    if (!array_key_exists('url', get_defined_vars()) || !$url) {
      throw new \InvalidArgumentException('Error creating Http object. Please provide a URL');
    }
    $this->url = $url;
    $this->curlHandle = curl_init($url);
    $this->setOption(CURLOPT_RETURNTRANSFER, true);
  }

  private function setOption ($name, $value) {
    curl_setopt($this->curlHandle, $name, $value);
    $this->options[$name] = $value;
  }

  public function setMethod ($method) {
    if (strtolower($method) == 'get') {
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

  public function getUrl () {
    return $this->url;
  }
}
