<?php namespace Pact;

class Interaction implements \JsonSerializable {
  private $providerState;
  private $description;
  private $request = [];
  private $response = [];

  public function given ($state) {
    $this->providerState = $state;
    return $this;
  }

  public function uponReceiving ($desc) {
    $this->description = $desc;
    return $this;
  }

  public function withRequest ($firstParameter, $path = null, $headers = null, $body = null) {
    if (is_array($firstParameter)) {
      if (array_key_exists('method', $firstParameter)) {
        $this->request['method'] =  strtolower($firstParameter['method']);
      }
      if (array_key_exists('path', $firstParameter)) {
        $this->request['path'] = $firstParameter['path'];
      }
      if (array_key_exists('query', $firstParameter)) {
        $this->request['query'] = $firstParameter['query'];
      }
      if (array_key_exists('headers', $firstParameter)) {
        $this->request['headers'] = $firstParameter['headers'];
      }
      if (array_key_exists('body', $firstParameter)) {
        $this->request['body'] = $firstParameter['body'];
      }
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
    if (!array_key_exists('method', $this->request) || !array_key_exists('path', $this->request) || !$this->request['method'] || !$this->request['path']) {
      throw new \InvalidArgumentException('withRequest requires a "method" and "path" parameter');
    }
    return $this;
  }

  public function willRespondWith ($firstParameter, $headers = null, $body = null) {
    if (is_array($firstParameter)) {
      if (array_key_exists('status', $firstParameter)) {
        $this->response['status'] = $firstParameter['status'];
      }
      if (array_key_exists('headers', $firstParameter)) {
        $this->response['headers'] = $firstParameter['headers'];
      }
      if (array_key_exists('body', $firstParameter)) {
        $this->response['body'] = $firstParameter['body'];
      }
    }
    else {
      $this->response['status'] = $firstParameter;
      if (!is_null($headers)) {
        $this->response['headers'] = $headers;
      }
      if (!is_null($body)) {
        $this->response['body'] = $body;
      }
    }

    if (!array_key_exists('status', $this->response) || !$this->response['status']) {
      throw new \InvalidArgumentException('willRespondWith requires a "status" parameter');
    }
    return $this;
  }

  public function jsonSerialize() {
    return [
      'description' => $this->description,
      'providerState' => $this->providerState,
      'request' => $this->request,
      'response' => $this->response
    ];
  }
}
