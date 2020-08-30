<?php defined('_JEXEC') or die; ?>

<input id="token" type="hidden" name="<?php echo JSession::getFormToken(); ?>" value="1"/>

<?php

$this->questionCounter = 0;

foreach ($this->questions as $this->question):
    $this->questionCounter++; // TODO: Input finish button when questionCounter is 16
    echo $this->loadTemplate('question');
endforeach;

?>
