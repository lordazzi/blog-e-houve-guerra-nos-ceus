<?php

class Book {

  private $bookId;

  private $headingMetaData;
  private $metaData;

  private static $instances = array();

  static function getInstance($bookId) {
    if (!isset(self::$instances[$bookId])) {
      self::$instances[$bookId] = new self($bookId);
    }

    return self::$instances[$bookId];
  }

  private function __construct($bookId) {
    $this->bookId = $bookId;
  }

  function __destruct() {
    unset(self::$instances[$this->bookId]);
  }

  static function getList() {
    $booksNames = File::readJSON(BOOK_PATH."index.json");
    $booksMetaData = array();
    foreach ($booksNames as $book) {
      $metaData = Book::getInstance($book)->getBookMetaData($book);
      if (count($metaData->chapters)) {
        array_push($booksMetaData, $metaData);
      }
    }

    return $booksMetaData;
  }

  function getBookHeadingMetaData() {
    $bookMetaData = File::readJSON(BOOK_PATH."/$this->bookId/$this->bookId.json");
    $bookMetaData->id = $this->bookId;
    $bookMetaData->url = "/index.php/book/{$bookMetaData->id}/";

    $this->headingMetaData = $bookMetaData;
    return $bookMetaData;
  }

  function getBookMetaData() {
    $bookMetaData = $this->getBookHeadingMetaData();
    $chapters = array();

    foreach ($bookMetaData->chapters as $chapter) {
      //  check if chapter is published
      $bookChapter = BookChapter::getInstance($this->bookId, $chapter);
      $chapterMetaData = $bookChapter->getChapterHeadingMetaData();
      if ($chapterMetaData !== null) {
        array_push($chapters, $chapterMetaData);
      }
    }

    $bookMetaData->chapters = $chapters;
    $this->metaData = $bookMetaData;
    return $bookMetaData;
  }
}

?>