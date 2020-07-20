<?php

class BookChapter {

  private $bookId;
  private $chapterId;

  private $headingMetaData;
  private $metaData;

  private static $instances = array();

  static function getInstance($bookId, $chapterId) {
    $key = "$bookId-$chapterId";
    if (!isset(self::$instances[$key])) {
      self::$instances[$key] = new self($bookId, $chapterId);
    }

    return self::$instances[$key];
  }

  private function __construct($bookId, $chapterId) {
    $this->bookId = $bookId;
    $this->chapterId = $chapterId;
  }

  function __destruct() {
    $key = "$this->bookId-$this->chapterId";
    unset(self::$instances[$key]);
  }

  function getChapterHeadingMetaData() {
    if ($this->headingMetaData) {
      return $this->headingMetaData;
    }

    try {
      $chapterHeadingData = File::readJSON(BOOK_PATH . "$this->bookId/$this->chapterId.json");
      $fileData = (object) @stat(BOOK_PATH . "$this->bookId/$this->chapterId.md");

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

    $book = Book::getInstance($this->bookId);
    $bookMetadata = $book->getBookHeadingMetaData();
    $chapterHeadingData->bookName = $bookMetadata->title;
    $chapterHeadingData->template = "article-head";
    $chapterHeadingData->website = "https://$_SERVER[HTTP_HOST]";
    $chapterHeadingData->id = $this->chapterId;
    $chapterHeadingData->url = "/index.php/book/{$bookMetadata->id}/chapter/{$this->chapterId}/";
    $chapterHeadingData->figure = null;
    $chapterHeadingData->isArticle = true;

    $this->headingMetaData = $chapterHeadingData;
    return $chapterHeadingData;
  }

  function getChapterMetaData() {
    if ($this->metaData) {
      return $this->metaData;
    }

    $chapterHeadingData = $this->getChapterHeadingMetaData($this->bookId, $this->chapterId);
    $chapterFooterData = (object) array();
    $chapterFooterData->template = "article-footer";

    try {
      $readme = File::readFile(BOOK_PATH . "$this->bookId/$this->chapterId.md");
    } catch (Exception $e) {
      return null;
    }

    if ($chapterHeadingData === null || $readme === null) {
      return null;
    }

    $chapterMetadata = (new ReadmeReader())->interpret($readme);

    foreach ($chapterMetadata as $meta) {
      if ($meta->template == "article-figure") {
        $imageFullPath = getImageUrl($meta->imagePath);
        $imageData = getimagesize(PUBLIC_FOLDER.'/'.$imageFullPath);

        $chapterHeadingData->figure = (object) array();
        $chapterHeadingData->figure->url = "/$imageFullPath";
        $chapterHeadingData->figure->mimeType = $imageData["mime"];
        $chapterHeadingData->figure->width = $imageData[0];
        $chapterHeadingData->figure->height = $imageData[1];
        break;
      }
    }

    array_unshift($chapterMetadata, $chapterHeadingData);
    array_push($chapterMetadata, $chapterFooterData);

    $this->metaData = $chapterMetadata;
    return $chapterMetadata;
  }

  function render() {
    $chapterMetadata = $this->getChapterMetaData();
    $chapterHeadingData = $this->getChapterHeadingMetaData();
    if ($chapterMetadata === null) {
      WebSite::renderNotFound();
      return;
    }

    WebSite::drawHeader($chapterHeadingData);
    foreach ($chapterMetadata as $templateMetadata) {
      $articleTemplater = new RainTPL();

      foreach ($templateMetadata as $key => $value) {
        $articleTemplater->assign($key, $value);
      }

      $articleTemplater->draw($templateMetadata->template);
    }
  }
}
