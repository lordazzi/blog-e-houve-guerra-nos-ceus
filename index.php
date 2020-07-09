<?php
$pathInfo = @$_SERVER['PATH_INFO'];
if (!$pathInfo) {
	header('location: /index.php/article/do-que-se-trata/');
  // require_once("$_SERVER[DOCUMENT_ROOT]/app/article-list.php");
} elseif (preg_match('/^\/article\//', $pathInfo)) {
	require_once("$_SERVER[DOCUMENT_ROOT]/app/config.php");
	require_once("$_SERVER[DOCUMENT_ROOT]/app/header.php");
  require_once("$_SERVER[DOCUMENT_ROOT]/app/open-article.php");
	require_once("$_SERVER[DOCUMENT_ROOT]/app/footer.php");
} else {
	header('location: /index.php/article/do-que-se-trata/');
  //  página 404
}
?>