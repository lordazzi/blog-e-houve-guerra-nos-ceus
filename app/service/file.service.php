<?php

class File {
  static function getJSON($path) {
    return json_decode(file_get_contents($path));
  }

  static function setJSON() {
    
  }
}

?>