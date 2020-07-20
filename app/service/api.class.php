<?php

class Api {

  private $pathParam;

  function __construct($routeParams) {
    $this->pathParam = $routeParams->pathParam;
    $this->queryParam = $routeParams->queryParam;
    $this->method = $routeParams->method;
  }

  function getResponse() {
    if ($this->pathParam->articles) {
      if ($this->method === "PUT") {
        return (new ApiArticleList())->update();
      } elseif ($this->method === "GET") {
        return (new ApiArticleList())->get();
      }

      return (object) array();
    }

    return json_encode((object) array());
  }
}

?>