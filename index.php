<?php
require_once 'HTMLGenerator.php';

$document = new HTMLDocument();

// Create a div element
$div = new HTMLElement("div", "This is a div", ["class" => "my-div"], ["background-color" => "lightblue"]);
$document->addElement($div);

// Create a paragraph element
$paragraph = new HTMLElement("p", "This is a paragraph", ["style" => "color: red;"], ["font-size" => "16px"]);
$document->addElement($paragraph);

// Create a heading element
$heading = new HTMLElement("h1", "This is a heading", ["id" => "main-heading"], ["text-align" => "center"]);
$document->addElement($heading);

// Render the document
$htmlContent = $document->render();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HTML Generator Example</title>
</head>
<body>
    <?php echo $htmlContent; ?>
</body>
</html>
