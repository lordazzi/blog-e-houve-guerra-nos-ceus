<?php

class Book {
  static function render($book) {
    return $book;
  }

  static function getList() {
    $booksNames = File::readJSON(BOOK_PATH."index.json");
    $booksMetaData = array();
    foreach ($booksNames as $book) {
      $metaData = Book::getBookMetaData($book);
      if (count($metaData->chapters)) {
        array_push($booksMetaData, $metaData);
      }
    }

    return $booksMetaData;
  }
  
  static function getBookMetaData($book) {
    $bookMetaData = File::readJSON(BOOK_PATH."/$book/$book.json");
    $chapters = array();

    foreach ($bookMetaData->chapters as $chapter) {
      //  check if chapter is published
      $chapterMetaData = BookChapter::getChapterHeadingMetaData($book, $chapter);
      if ($chapterMetaData !== null) {
        array_push($chapters, $chapterMetaData);
      }
    }

    $bookMetaData->path = $book;
    $bookMetaData->chapters = $chapters;

    return $bookMetaData;
  }
}

?>