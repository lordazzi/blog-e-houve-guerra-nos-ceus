<?php
require_once("$_SERVER[DOCUMENT_ROOT]/config.php");

// BookChapter::listChapters();

$pathInfo = @$_SERVER['PATH_INFO'];
$redirecting = WebSite::hasRedirectRegitred($pathInfo);

$website = new WebSite();
if (!$redirecting) {
  $website->getPage(new Route($pathInfo));
}

?>