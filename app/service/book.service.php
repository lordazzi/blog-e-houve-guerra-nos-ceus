<?php

class Book {
  static function render($book) {

  }

  static function list() {
    return File::readJSON(BOOK_PATH."index.json");
  }
}

?>