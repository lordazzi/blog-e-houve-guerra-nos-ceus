<?php

date_default_timezone_set("America/Sao_Paulo");

define("APP_BASE", "$_SERVER[DOCUMENT_ROOT]/../app/");
define("BOOK_PATH", "$_SERVER[DOCUMENT_ROOT]/../app/books/");
define("ARCHIVE_IMAGES_PATH", "$_SERVER[DOCUMENT_ROOT]/public_html/image-archive/");
define("TEMPLATE_PATH", APP_BASE."templates/");
define("TEMPLATE_CACHE_PATH", TEMPLATE_PATH."cache/");

function __autoload($class) {
	$class = strtolower($class);
	require_once(APP_BASE."service/$class.class.php");
}

?>