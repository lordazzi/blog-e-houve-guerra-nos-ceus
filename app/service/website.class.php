<?php

class WebSite {
  static function drawHeader($metadata) {
    $headerHtml = new RainTPL();
    $headerHtml->assign("books", Book::getList());
    $headerHtml->assign("metadata", $metadata);
    $headerHtml->draw("header");
  }

  static function hasRedirectRegitred($path) {
    //  redirect http to https in prod environment
    $isHttp = $_SERVER["REQUEST_SCHEME"] === 'http';
    $isProd = preg_match('/ehouveguerranosceus/', $_SERVER["SERVER_NAME"]);

    if ($isHttp && $isProd) {
      $redirectTo = "https://$_SERVER[SERVER_NAME]$_SERVER[REQUEST_URI]";
      header("location: $redirectTo");
      return true;
    }

    //  routes configured to redirect
    $path = preg_replace('/^\/|\/$/', "", $path);
    $path = $path === "" ? "index" : $path;
    $appConfig = File::readJSON(APP_BASE."app-config.json");
    $redirect = (array)$appConfig->redirect;
    $redirectTo = @$redirect[$path];

    if ($redirectTo) {
      header("location: /index.php$redirectTo");
      return true;
    }

    return false;
  }

  function getPage($routeParams) {
    $pathParam = $routeParams->pathParam;
    if ($pathParam->book && $pathParam->chapter) {
      $bookChapter = BookChapter::getInstance($pathParam->book, $pathParam->chapter);
      $bookChapter->render();
    } elseif ($pathParam->book) {
      $book = Book::getInstance($pathParam->book);
      $book->render();
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