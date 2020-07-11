<?php

class File {
  static function readJSON($path) {
    return (object) json_decode(File::readFile($path));
  }

  static function readFile($path) {
    return file_get_contents($path);
  }
}

?>