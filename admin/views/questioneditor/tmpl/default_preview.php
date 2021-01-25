<?php

defined('_JEXEC') or die;

$question = $this->question->question;
$this->questionID = $this->question->id;
$this->colourHex = $this->question->colour_hex;
$this->colourRGB = $this->question->colour_rgb;
$filepath = $this->question->filepath;
$imageAttributes = $filepath ? $this->question->image_attributes : '';
?>

<div class="question" style="border-color: <?php echo $this->colourHex; ?>">
    <div class="heading" style="background-color: <?php echo $this->colourHex; ?>;" onclick="toggleQuestion('<?php echo $this->questionID; ?>')">
        <h1><?php echo '[ID: ' . $this->questionID . '] <span id="previewQuestion">' . $question . '</span>'; ?></h1>
    </div>

    <?php if ($filepath): ?>
        <div id="iconChest" class="iconChest" style="<?php echo $imageAttributes; ?>">
            <figure id="figurePreview" style="width: 100%; height: 100%; margin: 0;">
                <img src="<?php echo JURI::root() . $filepath; ?>" alt="Progress Tool Icon">
            </figure>
        </div>
    <?php endif; ?>

    <div class="choices">
        <?php foreach ($this->choices as $this->choice): ?>
            <label class="choice" style="--outlineColour: <?php echo $this->colourHex; ?>; --optionColour: <?php echo $this->colourHex; ?>;">
                <input type="checkbox">

                <span class="box" style="--labelColour: <?php echo $this->colourRGB; ?>;">
                    <span class="text"><?php echo $this->choice->choice; ?></span>
                </span>
            </label>
        <?php endforeach; ?>
    </div>
</div>