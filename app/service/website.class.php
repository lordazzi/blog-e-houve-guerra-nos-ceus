<?php

class WebSite {
  static function hasRedirectRegitred($path) {
    //  redirect http to https in prod environment
    $isHttp = $_SERVER["REQUEST_SCHEME"] === 'http';
    $isProd = preg_match('/ehouveguerranosceus/', $_SERVER["REQUEST_URI"]);

    if ($isHttp and $isProd) {
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
  
  function __construct() {
    $headerHtml = new RainTPL();
    $headerHtml->assign("books", Book::getList());
    $headerHtml->draw("header");
  }

  function getPage($routeParams) {
    $pathParam = $routeParams->pathParam;
    if ($pathParam->book and $pathParam->chapter) {
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