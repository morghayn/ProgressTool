<?php defined('_JEXEC') or die; ?>

    <input id="token" type="hidden" name="<?php echo JSession::getFormToken(); ?>" value="1"/>

<?php

$this->count = 0;

echo $this->loadTemplate('heading');

foreach ($this->questions as $this->question):
    $this->colourHex = $this->question->colour_hex;
    $this->colourRGB = $this->question->colour_rgb;
    $this->count++;

    echo $this->loadTemplate('question');
endforeach;

echo $this->loadTemplate('timelineredirects');
?>