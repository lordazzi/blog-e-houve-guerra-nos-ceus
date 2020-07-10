<?php

class BookChapter {
  function __construct($book, $chapter) {
    try {
      $publicationHeadingData = File::getJSON(BOOK_PATH . "$book/$chapter.json");
      $readme = File::getJSON(BOOK_PATH . "$book/$chapter.json");
    } catch (e) {

    }
    $publicationHeadingData->template = "article-head";
  }
}

?>