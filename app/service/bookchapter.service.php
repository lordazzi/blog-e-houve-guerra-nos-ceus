<?php

class BookChapter {

  static function listChapters($page = 1) {
    $books = File::readJSON(BOOK_PATH."index.json");

    $books = scandir();
    $books = array_filter($books, "filter");
    sort($books);
    echo json_encode($books);
  }

  static function render($book, $chapter) {
    try {
      $publicationHeadingData = File::readJSON(BOOK_PATH . "$book/$chapter.json");
      $readme = File::readFile(BOOK_PATH . "$book/$chapter.md");
    } catch (Exception $e) {
      BookChapter::renderNotFound();
      return;
    }

    $publicationHeadingData->template = "article-head";
    $publicationMetadata = (new ReadmeReader())->interpret($readme);
    array_unshift($publicationMetadata, $publicationHeadingData);
    
    echo "<article class=\"postagem\">";
    foreach ($publicationMetadata as $templateMetadata) {
      $articleTemplater = new RainTPL();

      foreach ($templateMetadata as $key => $value) {
        $articleTemplater->assign($key, $value);
      }

      $articleTemplater->draw($templateMetadata->template);
    }
    echo "</article>";
  }

  static function renderNotFound() {
    (new RainTPL())->draw("not-found"); exit;
  }
}
