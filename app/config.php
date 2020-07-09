<?php

define("ARTICLES_PATH", "$_SERVER[DOCUMENT_ROOT]/articles/");
define("ARTICLES_IMAGES_PATH", "$_SERVER[DOCUMENT_ROOT]/image-archive/");
define("TEMPLATE_PATH", "$_SERVER[DOCUMENT_ROOT]/app/templates/");
define("TEMPLATE_CACHE_PATH", TEMPLATE_PATH."cache/");

function __autoload($class) {
	$class = strtolower($class);
	require_once("$_SERVER[DOCUMENT_ROOT]/app/service/$class.service.php");
}

?>