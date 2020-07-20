<?php
require_once("$_SERVER[DOCUMENT_ROOT]/config.php");

$pathInfo = @$_SERVER['PATH_INFO'];

$api = new Api(new Route($pathInfo));
echo json_encode($api->getResponse());

?>