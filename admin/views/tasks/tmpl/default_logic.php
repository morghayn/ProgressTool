<?php defined('_JEXEC') or die; ?>

<!-- Logic -->
<div class="grouping" style="display: block;">
    <h1>Logic</h1>

    <label class="choice" style="--outlineColour: <?php echo $this->colourHex; ?>; --optionColour: <?php echo $this->colourHex; ?>;">
        <input type="checkbox" <?php echo($this->task->logic_id == 0 ? 'checked' : ''); ?>>
        <span class="box" style="--labelColour: <?php echo $this->colourRGB; ?>;">
            <span class="text">OR</span>
        </span>
    </label>

    <label class="choice" style="--outlineColour: <?php echo $this->colourHex; ?>; --optionColour: <?php echo $this->colourHex; ?>;">
        <input type="checkbox" <?php echo($this->task->logic_id == 1 ? 'checked' : ''); ?>>
        <span class="box" style="--labelColour: <?php echo $this->colourRGB; ?>;">
            <span class="text">AND</span>
        </span>
    </label>

</div>