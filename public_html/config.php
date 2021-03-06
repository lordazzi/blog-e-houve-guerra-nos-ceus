<?php

date_default_timezone_set("America/Sao_Paulo");

define("APP_BASE", "$_SERVER[DOCUMENT_ROOT]/../app/");
define("DATA_CACHE", APP_BASE."/data-cache/");
define("BOOK_PATH", "$_SERVER[DOCUMENT_ROOT]/../books/");
define("PUBLIC_FOLDER", "$_SERVER[DOCUMENT_ROOT]");
define("TEMPLATE_PATH", APP_BASE."templates/");
define("TEMPLATE_CACHE_PATH", TEMPLATE_PATH."cache/");

function __autoload($class) {
	$class = strtolower($class);
	require_once(APP_BASE."service/$class.class.php");
}

function getImageUrl($imagePath) {
  return "image-archive/{$imagePath}";
}

function isProd() {
  return !!preg_match('/ehouveguerranosceus/', $_SERVER["SERVER_NAME"]);
}

?>