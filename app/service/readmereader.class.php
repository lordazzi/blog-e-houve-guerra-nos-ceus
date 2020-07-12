<?php

class ReadmeReader {

  public function interpret($readmeContent) {
    $resultSet = array();
    $currentHeading = $this->createHeadedObject();
    $articleLines = explode("\n", str_replace("\r", "", $readmeContent));
    
    foreach ($articleLines as $line) {
      $line = trim($line);

      if (!$line) {
        continue;
      }

      if ($this->isMdFigure($line)) {
        array_push($resultSet, $this->castFigureMdToFigureObject($line));
        $currentHeading = $this->createHeadedObject();
      } elseif ($this->isMdHeading($line)) {
        array_push($resultSet, $currentHeading);
        $currentHeading = $this->createHeadedObject();
        $currentHeading->title = $this->castHeadingMdToHeadingText($line);
      } elseif ($this->isQuotationCite($line)) {
        $currentHeading->cite = $this->cleanMdQuote($line);
      } elseif ($this->isQuotation($line)) {
        if ($currentHeading->template !== "article-quotation") {
          array_push($resultSet, $currentHeading);
          $currentHeading = $this->createHeadedObject();
          $currentHeading->template = "article-quotation";
          $currentHeading->cite = null;
        }

        array_push($currentHeading->paragraphs, $this->castTextFormatation($this->cleanMdQuote($line)));
      } else {
        array_push($currentHeading->paragraphs, $this->castTextFormatation($line));
      }
    }
    
    array_push($resultSet, $currentHeading);
    return $resultSet;
  }

  private function castTextFormatation($paragraph) {
    $paragraph = $this->castMdFormatationToTag($paragraph, '***', '<b><i>', '</i></b>');
    $paragraph = $this->castMdFormatationToTag($paragraph, '**', '<b>', '</b>');
    $paragraph = $this->castMdFormatationToTag($paragraph, '*', '<i>', '</i>');
    $paragraph = $this->castMdFormatationToTag($paragraph, '_', '<i>', '</i>');

    return $paragraph;
  }

  private function castMdFormatationToTag($paragraph, $mdSymbol, $tagOpen, $tagClose) {
    $escapedMdSymbol = preg_quote($mdSymbol, '<\\');

    $paragraph = preg_replace('/('.$escapedMdSymbol.'\w*'.$escapedMdSymbol.')/', "$tagOpen\$1$tagClose", $paragraph);
    $paragraph = str_replace($tagOpen.$mdSymbol, $tagOpen, $paragraph);
    $paragraph = str_replace($mdSymbol.$tagClose, $tagClose, $paragraph);

    return $paragraph;
  }

  private function cleanMdQuote($line) {
    return preg_replace('/(^\>(\>)?)/', '', $line);
  }
  
  private function createHeadedObject() {
    $currentHeading = (object) array();
    $currentHeading->title = null;
    $currentHeading->paragraphs = array();
    $currentHeading->template = "article-paragraphed";
    return $currentHeading;
  }

  private function isMdFigure($line) {
    return !!preg_match('/^\!\[[^\]]*\]\([^\)]*\)$/', $line);
  }

  private function isMdHeading($line) {
    return !!preg_match('/^\#/', $line);
  }
  
  private function isQuotation($line) {
    return !!preg_match('/^(\>)/', $line);
  }

  private function isQuotationCite($line) {
    return !!preg_match('/^(\>\>)/', $line);
  }

  private function castFigureMdToFigureObject($line) {
    $figure = (object) array();
    $figure->template = "article-figure";
    $figure->caption = preg_replace('/(^\!\[|\].*$)/', "", $line);
    $figure->imagePath = preg_replace('/(^.*\(|\)$)/', "", $line);

    return $figure;
  }

  private function castHeadingMdToHeadingText($line) {
    return preg_replace('/^\#\s*/', "", $line);
  }
}

?>