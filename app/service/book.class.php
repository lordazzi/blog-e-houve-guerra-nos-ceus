<?php

class Book {

  private $bookName;

  private $headingMetaData;
  private $metaData;

  private static $instances = array();

  static function getInstance($bookName) {
    if (!isset(self::$instances[$bookName])) {
      self::$instances[$bookName] = new self($bookName);
    }

    return self::$instances[$bookName];
  }

  private function __construct($bookName) {
    $this->bookName = $bookName;
  }

  function __destruct() {
    unset(self::$instances[$this->bookName]);
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
    $bookMetaData = File::readJSON(BOOK_PATH."/$this->bookName/$this->bookName.json");
    $bookMetaData->path = $this->bookName;
    $bookMetaData->url = "/index.php/book/{$bookMetaData->path}/";

    $this->headingMetaData = $bookMetaData;
    return $bookMetaData;
  }

  function getBookMetaData() {
    $bookMetaData = $this->getBookHeadingMetaData();
    $chapters = array();

    foreach ($bookMetaData->chapters as $chapter) {
      //  check if chapter is published
      $bookChapter = BookChapter::getInstance($this->bookName, $chapter);
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