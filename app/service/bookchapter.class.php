<?php

class BookChapter {

  private $bookName;
  private $chapterName;

  private $headingMetaData;
  private $metaData;

  private static $instances = array();

  static function getInstance($bookName, $chapterName) {
    $key = "$bookName-$chapterName";
    if (!isset(self::$instances[$key])) {
      self::$instances[$key] = new self($bookName, $chapterName);
    }

    return self::$instances[$key];
  }

  private function __construct($bookName, $chapterName) {
    $this->bookName = $bookName;
    $this->chapterName = $chapterName;
  }

  function __destruct() {
    $key = "$this->bookName-$this->chapterName";
    unset(self::$instances[$key]);
  }

  function getChapterHeadingMetaData() {
    if ($this->headingMetaData) {
      return $this->headingMetaData;
    }

    try {
      $chapterHeadingData = File::readJSON(BOOK_PATH . "$this->bookName/$this->chapterName.json");
      $fileData = (object) @stat(BOOK_PATH . "$this->bookName/$this->chapterName.md");

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

    $book = Book::getInstance($this->bookName);
    $bookMetadata = $book->getBookHeadingMetaData();
    $chapterHeadingData->bookName = $bookMetadata->title;
    $chapterHeadingData->template = "article-head";
    $chapterHeadingData->website = "https://$_SERVER[HTTP_HOST]";
    $chapterHeadingData->path = $this->chapterName;
    $chapterHeadingData->url = "/index.php/book/{$bookMetadata->path}/chapter/{$this->chapterName}/";
    $chapterHeadingData->figure = null;

    $this->headingMetaData = $chapterHeadingData;
    return $chapterHeadingData;
  }

  function getChapterMetaData($book, $chapter) {
    if ($this->metaData) {
      return $this->metaData;
    }

    $chapterHeadingData = $this->getChapterHeadingMetaData($book, $chapter);

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

    foreach ($chapterMetadata as $meta) {
      if ($meta->template == "article-figure") {
        $imageFullPath = getImageUrl($meta->imagePath);
        $imageData = getimagesize(ARCHIVE_IMAGES_PATH.$imageFullPath);

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
    $chapterMetadata = $this->getChapterMetaData($this->bookName, $this->chapterName);
    $chapterHeadingData = $this->getChapterHeadingMetaData($this->bookName, $this->chapterName);
    if ($chapterMetadata === null) {
      $this->renderNotFound();
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

  private function renderNotFound() {
    (new RainTPL())->draw("not-found"); exit;
  }
}
