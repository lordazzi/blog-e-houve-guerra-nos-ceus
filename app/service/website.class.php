<?php

class WebSite {

  static function renderNotFound() {
    (new RainTPL())->draw("not-found"); exit;
  }

  static function drawHeader($metadata) {
    $headerHtml = new RainTPL();
    $headerHtml->assign("books", Book::getList());
    $headerHtml->assign("metadata", $metadata);
    $headerHtml->draw("header");
  }

  static function hasRedirectRegitred($path) {
    //  redirect http to https in prod environment
    $isHttp = $_SERVER["REQUEST_SCHEME"] === 'http';
    $isProd = isProd();

    if ($isHttp && $isProd) {
      $redirectTo = "https://$_SERVER[SERVER_NAME]$_SERVER[REQUEST_URI]";
      header("location: $redirectTo");
      return true;
    }

    //  routes configured to redirect
    $path = preg_replace('/^\/|\/$/', "", $path);
    $path = $path === "" ? "index" : $path;
    $appConfig = File::readJSON(APP_BASE."application.json");
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
    if (@$pathParam->book && @$pathParam->chapter) {
      $bookChapter = BookChapter::getInstance($pathParam->book, $pathParam->chapter);
      $bookChapter->render();
    } elseif (@$pathParam->book) {
      $book = Book::getInstance($pathParam->book);
      if ($book == null) {
        BookChapter::renderNotFound();
      }

      $book->render();
    } else {
      $chapters = BookChapter::listByPublishedDate();
      $this->renderChapterList($chapters);
    }
  }

  function renderChapterList($chapters) {
    WebSite::drawHeader((object) array());

    $chapterList = new RainTPL();
    $chapterList->assign("chapters", $chapters);
    $chapterList->draw("chapter-list");
  }

  function __destruct() {
    $headerHtml = new RainTPL();
    $headerHtml->draw("footer");
  }
}
?>