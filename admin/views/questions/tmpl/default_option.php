<?php defined('_JEXEC') or die; ?>

<label class="choice" style="--outlineColour: <?php echo $this->colourHex; ?>; --optionColour: <?php echo $this->colourHex; ?>;">
    <input type="checkbox">
    <span class="box" style="--labelColour: <?php echo $this->colourRGB; ?>;">
        <span class="text">
            <?php echo $this->choice->choice; ?>
        </span>
    </span>
</label>