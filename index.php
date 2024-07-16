<?php
require_once 'HTMLGenerator.php';

$document = new HTMLDocument();
$document->setTitle("HTML Generator Example");
$document->setCharset("UTF-8");
$document->setViewport("width=device-width, initial-scale=1.0");

// Add a meta tag
$metaDescription = $document->createElement("meta", "", ["name" => "description", "content" => "An example of HTML generation using PHP."]);
$document->addHeadElement($metaDescription);

// Add styles or scripts if needed
$style = $document->createElement("style", "body { font-family: Arial, sans-serif; }");
$document->addHeadElement($style);

// Create and add body elements
$div = $document->createElement("div", "This is a div", ["class" => "my-div"], ["background-color" => "lightblue"]);
$document->addBodyElement($div);

$paragraph = $document->createElement("p", "This is a paragraph", ["style" => "color: red;"], ["font-size" => "16px"]);
$document->addBodyElement($paragraph);

$heading = $document->createElement("h1", "This is a heading", ["id" => "main-heading"], ["text-align" => "center"]);
$document->addBodyElement($heading);

// Render and output the document
echo $document->render();
?>
