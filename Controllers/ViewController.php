<?php
  class View
  {
    private $title;
    private $content;
    private $style;
    private $directory = "Elements/";
    private $templateExtention = ".html";
    private $styleExtention = ".css";
    private $templateBase = "Templates/template.php";

    public function loadHtml($fileName)
    {
      $html = "";
      $html .= "<div id='" . str_replace($this->templateExtention, "", $fileName) ."'>";
      $html .= file_get_contents($this->directory . $fileName);
      $html .= "</div>";

      return $html;
    }
    public function loadCss($fileName)
    {
      $css = "<link rel='stylesheet' href='" . $this->directory . $fileName ."'>";
      return $css;
    }
    public function renderPage($title)
    {
      $template = file_get_contents($this->directory . $this->templateBase);
      $html = "";
      $css = "";
      $directoryList = scandir($this->directory);
      foreach ($directoryList as $key => $value) {
        if(strpos($value, $this->templateExtention) !== False) {
          $html .= $this->loadHtml($value);
        }
        if(strpos($value, $this->styleExtention) !== False) {
          $css .= $this->loadCss($value);
        }
      }
      $template = str_replace('%%TITLE%%', $title, $template);
      $template = str_replace('%%CONTENT%%', $html, $template);
      $template = str_replace('%%STYLE%%', $css, $template);
      $template = str_replace('%%MENU%%', file_get_contents($this->directory . "Templates/menu.php"), $template);
      $template = str_replace('%%BOTTOM%%', file_get_contents($this->directory . "Templates/bottom.php"), $template);
      echo $template;
    }
  }
