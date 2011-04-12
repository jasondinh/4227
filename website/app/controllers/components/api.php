<?php

App::import('HttpSocket');

class ApiComponent extends Object {
  
  var $base_url = 'http://localhost/4227/api/';
  function get($method, $debug = FALSE) {
    $url = $this->base_url.$method;
    $http = new HttpSocket();
    $respond = $http->get($url);
    if ($debug) {
      debug($respond);
    }
    return json_decode($respond, true);
  }
  
  function post($method, $data, $debug = FALSE) {
    $url = $this->base_url.$method;
    $http = new HttpSocket();
    $respond = $http->post($url, $data);
    if ($debug) {
      debug($respond);
    }
    return json_decode($respond, true);
  }
}
