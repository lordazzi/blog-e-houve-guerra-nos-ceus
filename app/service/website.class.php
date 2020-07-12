<?php

class WebSite {
  static function hasRedirectRegitred($path) {
    $path = preg_replace('/^\/|\/$/', "", $path);
    $appConfig = File::readJSON(APP_BASE."app-config.json");
    $redirect = (array)$appConfig->redirect;
    $redirectTo = @$redirect[$path];

    if ($redirectTo) {
      header("location: /index.php$redirectTo");
      return true;
    }

    return false;
  }
  
  function __construct() {
    $headerHtml = new RainTPL();
    $headerHtml->assign("books", Book::getList());
    $headerHtml->draw("header");
  }

  function getPage($routeParams) {
    $pathParam = $routeParams->pathParam;
    if ($pathParam->book && $pathParam->chapter) {
      BookChapter::render($pathParam->book, $pathParam->chapter);
    } elseif ($pathParam->book) {
      Book::render($pathParam->book);
    } else {
      BookChapter::renderNotFound();
    }
  }

  function __destruct() {
    $headerHtml = new RainTPL();
    $headerHtml->draw("footer");
  }
}
?>