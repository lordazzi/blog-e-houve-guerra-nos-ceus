<?php

class ReadmeReader {

  public function interpret($readmeContent) {
    $resultSet = array();
    $currentHeading = $this->createHeadingObject();
    $articleLines = explode("\n", str_replace("\r", "", $readmeContent));
    
    foreach ($articleLines as $line) {
      $line = trim($line);

      if (!$line) {
        continue;
      }

      if ($this->isMdFigure($line)) {
        array_push($resultSet, $this->castFigureMdToFigureObject($line));
        $currentHeading = $this->createHeadingObject();
      } elseif ($this->isMdHeading($line)) {
        array_push($resultSet, $currentHeading);
        $currentHeading = $this->createHeadingObject();
        $currentHeading->title = $this->castHeadingMdToHeadingText($line);
      } else {
        array_push($currentHeading->paragraphs, $line);
      }
    }
    
    array_push($resultSet, $currentHeading);
    return $resultSet;
  }
  
  private function createHeadingObject() {
    $currentHeading = (object) array();
    $currentHeading->title = null;
    $currentHeading->paragraphs = array();
    $currentHeading->template = "paragraphed";
    return $currentHeading;
  }

  private function isMdFigure($line) {
    return !!preg_match('/^\!\[[^\]]*\]\([^\)]*\)$/', $line);
  }

  private function isMdHeading($line) {
    return !!preg_match('/^\#/', $line);
  }

  private function castFigureMdToFigureObject($line) {
    $figure = (object) array();
    $figure->template = "figure";
    $figure->caption = preg_replace('/(^\!\[|\].*$)/', "", $line);
    $figure->imagePath = preg_replace('/(^.*\(|\)$)/', "", $line);

    return $figure;
  }

  private function castHeadingMdToHeadingText($line) {
    return preg_replace('/^\#\s*/', "", $line);
  }
}

?>