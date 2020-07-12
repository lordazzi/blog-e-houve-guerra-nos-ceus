<?php

date_default_timezone_set("America/Sao_Paulo");

define("APP_BASE", "$_SERVER[DOCUMENT_ROOT]/../app/");
define("BOOK_PATH", "$_SERVER[DOCUMENT_ROOT]/../books/");
define("ARCHIVE_IMAGES_PATH", "$_SERVER[DOCUMENT_ROOT]/www/image-archive/");
define("TEMPLATE_PATH", APP_BASE."templates/");
define("TEMPLATE_CACHE_PATH", TEMPLATE_PATH."cache/");

function __autoload($class) {
	$class = strtolower($class);
	require_once("$_SERVER[DOCUMENT_ROOT]/../app/service/$class.class.php");
}

?>