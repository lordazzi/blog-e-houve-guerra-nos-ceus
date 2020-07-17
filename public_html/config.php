<?php

date_default_timezone_set("America/Sao_Paulo");

define("APP_BASE", "$_SERVER[DOCUMENT_ROOT]/../app/");
define("BOOK_PATH", "$_SERVER[DOCUMENT_ROOT]/../books/");
define("PUBLIC_FOLDER", "$_SERVER[DOCUMENT_ROOT]");
define("TEMPLATE_PATH", APP_BASE."templates/");
define("TEMPLATE_CACHE_PATH", TEMPLATE_PATH."cache/");

function __autoload($class) {
	$class = strtolower($class);
	require_once(APP_BASE."service/$class.class.php");
}

function getImageUrl($imagePath, $size = 670) {
  return "image-archive/{$imagePath}/{$imagePath}-w$size.jpg";
}
?>