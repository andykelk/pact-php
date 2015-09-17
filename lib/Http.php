<?php namespace Pact;

class Http {
  static public function makeRequest($method, $url, $body = null) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    if (strtolower($method) == 'get') {
      curl_setopt($ch, CURLOPT_HTTPHEADER, ['X-Pact-Mock-Service: true']);
    }
    else {
      if (strtolower($method) == 'put') {
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
      }
      else if (strtolower($method) == 'post') {
        curl_setopt($ch, CURLOPT_POST, 1);
      }
      curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json','X-Pact-Mock-Service: true']);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
    }
    return curl_exec($ch);
  }
}
