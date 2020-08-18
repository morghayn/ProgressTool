<?php

defined('_JEXEC') or die;

$this->questionCounter = 0;

?>

<input id="token" type="hidden" name="<?php echo JSession::getFormToken(); ?>" value="1"/>

<?php

echo $this->loadTemplate('heading');

foreach ($this->questions as $this->question):
    $this->colourHex = $this->question->colour_hex;
    $this->colourRGB = $this->question->colour_rgb;
    $this->questionCounter++; // TODO: Input finish button when questionCounter is 16

    echo $this->loadTemplate('question');
endforeach;

?>
