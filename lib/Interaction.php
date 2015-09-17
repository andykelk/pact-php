<?php namespace Pact;

class Interaction implements \JsonSerializable {
  private $providerState;
  private $description;
  private $request = array();
  private $response = array();

  public function given ($state) {
    $this->providerState = $state;
    return $this;
  }

  public function uponReceiving ($desc) {
    $this->description = $desc;
    return $this;
  }

  public function withRequest ($firstParameter, $path, $headers = null, $body = null) {
    if (is_array($firstParameter)) {
      $this->request['method'] = strtolower($firstParameter['method']);
      $this->request['path'] = $firstParameter['path'];
      $this->request['query'] = $firstParameter['query'];
      $this->request['headers'] = $firstParameter['headers'];
      $this->request['body'] = $firstParameter['body'];
    }
    else {
      $this->request['method'] = strtolower($firstParameter);
      $this->request['path'] = $path;
      if (!is_null($headers)) {
        $this->request['headers'] = $headers;
      }
      if (!is_null($body)) {
        $this->request['body'] = $body;
      }
    }
    if (!$this->request['method'] || !$this->request['path']) {
      throw new \InvalidArgumentException('withRequest requires a "method" and "path" parameter');
    }
    return $this;
  }

  public function willRespondWith ($firstParameter, $headers = null, $body = null) {
    if (is_array($firstParameter)) {
      $this->response['status'] = $firstParameter['status'];
      if (!is_null($headers)) {
        $this->response['headers'] = $firstParameter['headers'];
      }
      if (!is_null($body)) {
        $this->response['body'] = $firstParameter['body'];
      }
    }
    else {
      $this->response['status'] = $firstParameter;
      $this->response['headers'] = $headers;
      $this->response['body'] = $body;
    }

    if (!$this->response['status']) {
      throw new \InvalidArgumentException('willRespondWith requires a "status" parameter');
    }
    return $this;
  }

  public function jsonSerialize() {
    return array(
      'description' => $this->description,
      'providerState' => $this->providerState,
      'request' => $this->request,
      'response' => $this->response
    );
  }
}
