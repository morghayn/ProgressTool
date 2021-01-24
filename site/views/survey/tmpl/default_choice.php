<?php defined('_JEXEC') or die; ?>

<label class="choice" style="--outlineColour: <?php echo $this->colourHex; ?>; --optionColour: <?php echo $this->colourHex; ?>;">
    <input id="qcid-<?php echo $this->choiceID; ?>" type="checkbox" <?php echo $this->isChecked; ?>
           onclick="surveySelect('<?php echo $this->projectID . "','" . $this->choiceID; ?>')">

    <span class="box" style="--labelColour: <?php echo $this->colourRGB; ?>;">
        <span class="text"><?php echo $this->choice->choice; ?></span>
    </span>
</label>