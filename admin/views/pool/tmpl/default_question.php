<?php

defined('_JEXEC') or die;

$questionCounter = $this->questionCounter;
$question = $this->question->question;
$questionID = $this->question->id;
$colourHex = $this->question->colour_hex;
$colourRGB = $this->question->colour_rgb;
$filepath = $this->question->filepath;
$width = $filepath ? $this->question->width : 200;
$height = $filepath ? $this->question->height : 200;
$rightOffset = $filepath ? $this->question->right_offset : 0;
$bottomOffset = $filepath ? $this->question->bottom_offset : 0;

?>

<div class="masterChest" style="border-color: <?php echo $colourHex; ?>;">

    <?php if ($filepath): ?>
        <div id="iconChest" class="iconChest"
             style="width: <?php echo $width; ?>px; height:  <?php echo $height; ?>px; bottom:  <?php echo $bottomOffset; ?>px; right:  <?php echo $rightOffset; ?>px;">
            <figure id="figurePreview" style="width: 100%; height: 100%; margin: 0;">
                <img src="<?php echo '../' . $filepath; ?>" alt="yo not loading">
            </figure>
        </div>
    <?php endif; ?>

    <div class="masterChestHeadingChest" style="background-color: <?php echo $colourHex; ?>;"
         onclick="window.open('?option=com_progresstool&view=questionEditor&questionID=<?php echo $questionID; ?>')">
        <h2 class="masterChestHeading">
            <?php echo $questionCounter . '. ' . $question; ?>
        </h2>
    </div>

    <div class="optionsChest">
        <?php foreach ($this->choices[$questionID] as $this->choice): ?>
            <?php echo $this->loadTemplate('option'); ?>
        <?php endforeach; ?>
    </div>

</div>

