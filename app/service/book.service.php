<?php

class Book {
  static function render($book) {

  }

  static function list() {
    $booksNames = File::readJSON(BOOK_PATH."index.json");
    $booksMetaData = array();
    foreach ($booksNames as $book) {
      $metaData = Book::getBookMetaData($book);
      if (count($book->chapters)) {
        array_push($booksMetaData, $metaData);
      }
    }

    return $booksMetaData;
  }
  
  static function getBookMetaData($book) {
    $bookMetaData = File::readJSON(BOOK_PATH."/$book/$book.json");
    $chapters = array();
    foreach ($bookMetaData->chapters as $chapter) {
      $chapterMetaData = BookChapter::getChapterMetaData($book, $chapter);
      if ($chapterMetaData !== null) {
        array_push($chapters, $chapterMetaData);
      }
    }

    $bookMetaData->chapters = $chapters;
    return $bookMetaData;
  }
}

?>