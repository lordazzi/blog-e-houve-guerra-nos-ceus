<?php
$article = preg_replace('/^\/article\/|(\/)?$/', "", $_SERVER['PATH_INFO']);

$publicationHeadingData = json_decode(file_get_contents(ARTICLES_PATH . "$article.json"));
$publicationHeadingData->template = "article-head";
$readme = file_get_contents(ARTICLES_PATH . "$article.md");
$publicationMetadata = (new ReadmeReader())->interpret($readme);
array_unshift($publicationMetadata, $publicationHeadingData);

echo "<article class=\"postagem\">";
foreach ($publicationMetadata as $templateMetadata) {
  $articleTemplater = new RainTPL();
  $articleTemplater->tpl_dir = TEMPLATE_PATH;
  $articleTemplater->cache_dir = TEMPLATE_CACHE_PATH;

  foreach ($templateMetadata as $key => $value) {
    $articleTemplater->assign($key, $value);
  }

  $articleTemplater->draw($templateMetadata->template);
}
echo "</article>";
?>