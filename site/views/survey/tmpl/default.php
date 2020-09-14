<?php defined('_JEXEC') or die; ?>

<input id="token" type="hidden" name="<?php echo JSession::getFormToken(); ?>" value="1"/>

<?php

$this->questionCounter = 0;

echo $this->loadTemplate('title');

foreach ($this->questions as $this->question):
    $this->colourHex = $this->question->colour_hex;
    $this->colourRGB = $this->question->colour_rgb;
    $this->questionCounter++; // TODO: Input finish button when questionCounter is 16

    echo $this->loadTemplate('question');
endforeach;

?>

<div class="buttonChest">
    <?php foreach ($this->categories as $category): ?>
        <?php $onclick = "timelineRedirect($category->id, $this->projectID, $this->countryID)"; ?>
        <button onclick="<?php echo $onclick; ?>" style="background-color: <?php echo $category->colour_hex; ?>;">
            <?php echo $category->category; ?>
        </button>
    <?php endforeach; ?>
</div>
