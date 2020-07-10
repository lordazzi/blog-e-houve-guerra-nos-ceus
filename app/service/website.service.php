<?php

class WebSite {
  function __construct() {
    require_once("$_SERVER[DOCUMENT_ROOT]/../app/header.php");
  }

  function hasRedirectRegitred($pathInfo) {
    $appConfig = File::getJSON("app-config.json");
    $redirectTo = $appConfig->redirect[$pathInfo];

    if ($redirectTo) {
      header('redirect: $redirectTo');
      return true;
    }

    return false;
  }

  function getPage($routeParams) {
    if ($routeParams->book && $routeParams->chapter) {
      new BookChapter($routeParams->book, $routeParams->chapter);
    } elseif ($routeParams->book) {

    } else {

    }
  }

  function __destruct() {
    require_once("$_SERVER[DOCUMENT_ROOT]/../app/footer.php");
  }
}
?>