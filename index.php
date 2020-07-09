<?php
require_once("$_SERVER[DOCUMENT_ROOT]/app/config.php");
require_once("$_SERVER[DOCUMENT_ROOT]/app/header.php");

$pathInfo = @$_SERVER['PATH_INFO'];
if (!$pathInfo) {
  require_once("$_SERVER[DOCUMENT_ROOT]/app/article-list.php");
} elseif (preg_match('/^\/article\//', $pathInfo)) {
  require_once("$_SERVER[DOCUMENT_ROOT]/app/open-article.php");
} else {
  //  página 404
}

require_once("$_SERVER[DOCUMENT_ROOT]/app/footer.php");
?>