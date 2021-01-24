<?php

defined('_JEXEC') or die;
echo $this->loadTemplate('heading');

$this->count = 0;
foreach ($this->questions as $this->question):
    $this->colourHex = $this->question->colour_hex;
    $this->colourRGB = $this->question->colour_rgb;
    $this->score = $this->question->score;
    $this->questionID = $this->question->id;
    $this->count++;

    echo $this->loadTemplate('question');
endforeach;

echo $this->loadTemplate('timelineredirects');
?>

<input id="token" type="hidden" name="<?php echo JSession::getFormToken(); ?>" value="1"/>
