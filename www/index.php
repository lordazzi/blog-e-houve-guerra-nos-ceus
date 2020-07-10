<?php
require_once("$_SERVER[DOCUMENT_ROOT]/config.php");

$pathInfo = @$_SERVER['PATH_INFO'];
$website = new WebSite();
$redirecting = $website->hasRedirectRegitred($pathInfo);
if (!$redirecting) {
  $website->getPage(new Route($pathInfo));
}

?>