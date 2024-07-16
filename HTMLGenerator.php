<?php
class HTMLElement {
    protected $tag;
    protected $attributes = [];
    protected $styles = [];
    protected $content = "";

    public function __construct($tag, $content = "", $attributes = [], $styles = []) {
        $this->tag = $tag;
        $this->content = $content;
        $this->attributes = $attributes;
        $this->styles = $styles;
    }

    public function setAttribute($name, $value) {
        $this->attributes[$name] = $value;
    }

    public function setStyle($property, $value) {
        $this->styles[$property] = $value;
    }

    public function render() {
        $attributesString = $this->renderAttributes();
        $stylesString = $this->renderStyles();
        return "<{$this->tag}{$attributesString}{$stylesString}>{$this->content}</{$this->tag}>";
    }

    protected function renderAttributes() {
        $attributesString = "";
        foreach ($this->attributes as $name => $value) {
            $attributesString .= " {$name}=\"{$value}\"";
        }
        return $attributesString;
    }

    protected function renderStyles() {
        if (empty($this->styles)) {
            return "";
        }
        $stylesString = " style=\"";
        foreach ($this->styles as $property => $value) {
            $stylesString .= "{$property}: {$value}; ";
        }
        $stylesString .= "\"";
        return $stylesString;
    }
}

class HTMLDocument {
    private $headElements = [];
    private $bodyElements = [];
    private $title = '';
    private $charset = 'UTF-8';
    private $viewport = 'width=device-width, initial-scale=1.0';

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setCharset($charset) {
        $this->charset = $charset;
    }

    public function setViewport($viewport) {
        $this->viewport = $viewport;
    }

    public function addHeadElement(HTMLElement $element) {
        $this->headElements[] = $element;
    }

    public function addBodyElement(HTMLElement $element) {
        $this->bodyElements[] = $element;
    }

    public function createElement($tag, $content = "", $attributes = [], $styles = []) {
        return new HTMLElement($tag, $content, $attributes, $styles);
    }

    public function render() {
        $headContent = $this->renderHead();
        $bodyContent = $this->renderBody();
        return "<!DOCTYPE html>\n<html lang=\"en\">\n<head>\n{$headContent}\n</head>\n<body>\n{$bodyContent}\n</body>\n</html>";
    }

    private function renderHead() {
        $headContent = "<meta charset=\"{$this->charset}\">\n";
        $headContent .= "<meta name=\"viewport\" content=\"{$this->viewport}\">\n";
        $headContent .= "<title>{$this->title}</title>\n";
        foreach ($this->headElements as $element) {
            $headContent .= $element->render() . "\n";
        }
        return $headContent;
    }

    private function renderBody() {
        $bodyContent = "";
        foreach ($this->bodyElements as $element) {
            $bodyContent .= $element->render() . "\n";
        }
        return $bodyContent;
    }
}
?>
