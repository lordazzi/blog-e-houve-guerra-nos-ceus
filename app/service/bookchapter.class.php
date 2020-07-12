<?php

class BookChapter {

  static function listArticles($page = 1) {
    // $books = Book::list();
  }

  static function getChapterHeadingMetaData($book, $chapter) {
    try {
      $chapterHeadingData = File::readJSON(BOOK_PATH . "$book/$chapter.json");
      $fileData = (object) @stat(BOOK_PATH . "$book/$chapter.md");

      $lastEditTime = $fileData && @$fileData->mtime ? $fileData->mtime : null;
    } catch (Exception $e) {
      return null;
    }

    if (!@$chapterHeadingData || !@$chapterHeadingData->publishedDate) {
      return null;
    } elseif ($chapterHeadingData->publishedDate > time()) {
      return null;
    } elseif ($lastEditTime === null) {
      return null;
    }

    if ($lastEditTime > $chapterHeadingData->publishedDate) {
      $chapterHeadingData->lastEditDate = $lastEditTime;
    } else {
      $chapterHeadingData->lastEditDate = null;
    }
    
    $chapterHeadingData->template = "article-head";
    $chapterHeadingData->path = $chapter;
    return $chapterHeadingData;
  }

  static function getChapterMetaData($book, $chapter) {
    $chapterHeadingData = BookChapter::getChapterHeadingMetaData($book, $chapter);
    $chapterFooterData = (object) array();
    $chapterFooterData->template = "article-footer";

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
    array_push($chapterMetadata, $chapterFooterData);

    return $chapterMetadata;
  }

  static function render($book, $chapter) {
    $chapterMetadata = BookChapter::getChapterMetaData($book, $chapter);
    if ($chapterMetadata === null) {
      BookChapter::renderNotFound();
      return;
    }

    foreach ($chapterMetadata as $templateMetadata) {
      $articleTemplater = new RainTPL();

      foreach ($templateMetadata as $key => $value) {
        $articleTemplater->assign($key, $value);
      }

      $articleTemplater->draw($templateMetadata->template);
    }
  }

  static function renderNotFound() {
    (new RainTPL())->draw("not-found"); exit;
  }
}
