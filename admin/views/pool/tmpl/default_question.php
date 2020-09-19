<?php

defined('_JEXEC') or die;

$questionCounter = $this->questionCounter;
$question = $this->question->question;
$questionID = $this->question->id;
$colourHex = $this->question->colour_hex;
$colourRGB = $this->question->colour_rgb;

// For Icon
$filepath = $this->question->filepath;
$imageAttributes = $filepath ? $this->question->image_attributes : '';

?>

<div class="masterChest" style="border-color: <?php echo $colourHex; ?>;">

    <div class="masterChestHeadingChest" style="background-color: <?php echo $colourHex; ?>;" onclick="window.open('?option=com_progresstool&view=questionEditor&questionID=<?php echo $questionID; ?>')">
        <h2 class="masterChestHeading">
            <?php echo $questionCounter . '. ' . $question; ?>
        </h2>
    </div>

    <div id="chestContent_<?php echo $questionID; ?>">
        <?php if ($filepath): ?>
            <div class="iconChest" style="<?php echo $imageAttributes; ?>">
                <figure style="width: 100%; height: 100%; margin: 0;">
                    <img src="<?php echo JURI::root() . $filepath; ?>" alt="ProgressTool Icon">
                </figure>
            </div>
        <?php endif; ?>

        <div class="optionsChest">
            <?php foreach ($this->choices[$questionID] as $this->choice): ?>
                <?php echo $this->loadTemplate('option'); ?>
            <?php endforeach; ?>
        </div>
    </div>

</div>

