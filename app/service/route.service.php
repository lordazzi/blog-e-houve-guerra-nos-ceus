<?php

class Route {

  public $pathParam = (object) array();
  public $queryParam = (object) array();

  function __construct($route) {
    $route = explode("?", $route);
    
    for ($i=0; $i < count($route); $i+=2) { 
      $this->pathParam[$route[$i]] = $route[$i + 1];
    }

    $this->queryParam = (object) $_GET;
  }
}


?>