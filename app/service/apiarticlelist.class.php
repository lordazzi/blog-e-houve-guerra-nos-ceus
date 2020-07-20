<?php

class ApiArticleList {

  function get() {
    return json_decode(file_get_contents(DATA_CACHE."archives-published-date-sort.json"));
  }

  function update() {
    if (isProd()) {
      return $this->get();
    }

    $books = Book::getList();
    $chapters = array();

    foreach ($books as $book) {
      $bookMetadata = Book::getInstance($book->id)->getBookMetaData();
      foreach($bookMetadata->chapters as $chapter) {
        BookChapter::getInstance($book->id, $chapter->id)->getChapterMetaData();
      }
      $chapters = array_merge($chapters, $bookMetadata->chapters);
    }

    usort($chapters, function($a, $b) { return strcmp($b->publishedDate, $a->publishedDate);});
    file_put_contents(DATA_CACHE."archives-published-date-sort.json", json_encode($chapters));

    return $chapters;
  }
}

?>