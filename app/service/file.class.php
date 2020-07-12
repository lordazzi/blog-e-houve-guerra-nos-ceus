<?php

class File {
  static function readJSON($path) {
    $fileContent = File::readFile($path);

    if (!$fileContent) {
      return null;
    }

    return (object) json_decode($fileContent);
  }

  static function readFile($path) {
    if (file_exists($path)) {
      return file_get_contents($path);
    }
    
    return null;
  }
}

?>