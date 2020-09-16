<?php defined('_JEXEC') or die; ?>

<input id="token" type="hidden" name="<?php echo JSession::getFormToken(); ?>" value="1"/>

<?php

$this->questionCounter = 0;
foreach ($this->questions as $this->question):
    $this->questionCounter++;
    echo '<div class="flexxy" style="width: 100%; display: flex; align-items: center; margin-bottom: 75px;">';

    echo $this->loadTemplate('question');
    echo $this->loadTemplate('imageform');

    echo '</div>';
endforeach;

?>
