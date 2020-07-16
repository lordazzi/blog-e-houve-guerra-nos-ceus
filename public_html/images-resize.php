<?php
if ($_SERVER["SERVER_NAME"] !== "localhost") {
  http_response_code(404);
}

$queryString = $_SERVER["QUERY_STRING"];
if (!file_exists("image-archive/$queryString.jpg")) {
  exit;
}

if (!is_dir("image-archive/$queryString/")) {
  mkdir("image-archive/$queryString/");
}

$imagesInfo = getimagesize("image-archive/$queryString.jpg");
$widths = array(670, 530, 450, 400, 350, 300, 250 );

foreach ($widths as $newWidth) {
  if (file_exists("image-archive/$queryString/$queryString-w$newWidth.jpg")) {
    continue;
  }

  $width = $imagesInfo[0];
  $height = $imagesInfo[1];

  if ($newWidth < $width) {
    $height = floor($newWidth / $width * $height);
    $width = $newWidth;
  }

  $dst_image = imagecreatetruecolor($width, $height);
  $src_image = imagecreatefromjpeg("image-archive/$queryString.jpg");
  $dst_x = 0;
  $dst_y = 0;
  $src_x = 0;
  $src_y = 0;
  $dst_w = $width;
  $dst_h = $height;
  $src_w = $imagesInfo[0];
  $src_h = $imagesInfo[1];

  imagecopyresized($dst_image, $src_image, $dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h);
  imagejpeg($dst_image, "image-archive/$queryString/$queryString-w$newWidth.jpg");
  imagedestroy($dst_image);
  imagedestroy($src_image);
}
?>