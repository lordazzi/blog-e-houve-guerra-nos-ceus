<?php

class BookChapter {

  static function listArticles($page = 1) {
    // $books = Book::list();
  }

  static function getChapterHeadingMetaData($book, $chapter) {
    try {
      $chapterHeadingData = File::readJSON(BOOK_PATH . "$book/$chapter.json");
    } catch (Exception $e) {
      return null;
    }

    if (!@$chapterHeadingData || !@$chapterHeadingData->publishedDate) {
      return null;
    } elseif ($chapterHeadingData->publishedDate > time()) {
      return null;
    }
    
    $chapterHeadingData->template = "article-head";
    $chapterHeadingData->path = $chapter;
    return $chapterHeadingData;
  }

  static function getChapterMetaData($book, $chapter) {
    $chapterHeadingData = BookChapter::getChapterHeadingMetaData($book, $chapter);

    try {
      $readme = File::readFile(BOOK_PATH . "$book/$chapter.md");
    } catch (Exception $e) {
      return null;
    }

    if ($chapterHeadingData === null || $readme === null) {
      return null;
    }

    $chapterMetadata = (new ReadmeReader())->interpret($readme);
    array_unshift($chapterMetadata, $chapterHeadingData);

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
