<?php

class BookChapter {

  static function listArticles($page = 1) {
    // $books = Book::list();
  }

  // static function list($book) {
  //   File::readJSON(BOOK_PATH."index.json");
  // }

  static function getChapterMetaData($book, $chapter) {
    try {
      $chapterHeadingData = File::readJSON(BOOK_PATH . "$book/$chapter.json");
      $readme = File::readFile(BOOK_PATH . "$book/$chapter.md");
    } catch (Exception $e) {
      return null;
    }

    $chapterHeadingData->template = "article-head";
    $chapterMetadata = (new ReadmeReader())->interpret($readme);
    array_unshift($chapterMetadata, $chapterHeadingData);

    $notPublishedDateDefined = !$chapterHeadingData->publishedDate;
    $notPublishedYet = $chapterHeadingData->publishedDate < time();

    if ($notPublishedDateDefined || $notPublishedYet) {
      return null;
    }

    return $chapterMetadata;
  }

  static function render($book, $chapter) {
    $chapterMetadata = BookChapter::getChapterMetaData($book, $chapter);
    if ($chapterMetadata === null) {
      BookChapter::renderNotFound();
      return;
    }
    
    echo "<article class=\"postagem\">";
    foreach ($chapterMetadata as $templateMetadata) {
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
