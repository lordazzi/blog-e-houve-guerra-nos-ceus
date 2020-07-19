<?php

class Route {

  public $pathParam;
  public $queryParam;
  public $method;

  function __construct($route) {
    $route = preg_replace('/^\/|\/$/', "", $route);
    $route = explode("?", $route);
    $route = explode("/", $route[0]);
    $pathParam = array();

    for ($i=0; $i < count($route); $i+=2) {
      if (@$route[$i + 1]) {
        $pathParam[$route[$i]] = $route[$i + 1];
      } else {
        $pathParam[$route[$i]] = true;
      }
    }

    $this->pathParam = (object) $pathParam;
    $this->queryParam = (object) $_GET;
    $this->method = $_SERVER['REQUEST_METHOD'];
  }
}
?>