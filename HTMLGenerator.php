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
    private $elements = [];

    public function addElement(HTMLElement $element) {
        $this->elements[] = $element;
    }

    public function render() {
        $html = "";
        foreach ($this->elements as $element) {
            $html .= $element->render() . "\n";
        }
        return $html;
    }
}
?>
