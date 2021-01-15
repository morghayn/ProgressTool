<?php

defined('_JEXEC') or die;

$choice = $this->choice->choice;
$choiceID = $this->choice->id;
$colourHex = $this->question->colour_hex;
$colourRGB = $this->question->colour_rgb;

?>

<label class="optionChest" style="--outlineColour: <?php echo $colourHex; ?>; --optionColour: <?php echo $colourHex; ?>;">
    <input class="optionInput" type="checkbox">
    <span class="optionLabel" style="--labelColour: <?php echo $colourRGB; ?>;">
        <span class="option">
            <?php echo $choice; ?>
        </span>
    </span>
</label>