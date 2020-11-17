<?php defined('_JEXEC') or die; ?>

<input id="token" type="hidden" name="<?php echo JSession::getFormToken(); ?>" value="1"/>

<?php

$this->questionCounter = 0;

echo $this->loadTemplate('title');

foreach ($this->questions as $this->question):
    $this->colourHex = $this->question->colour_hex;
    $this->colourRGB = $this->question->colour_rgb;
    $this->questionCounter++;

    echo $this->loadTemplate('question');
endforeach;

echo $this->loadTemplate('timelineredirect');
?>