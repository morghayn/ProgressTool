<?php

defined('_JEXEC') or die;

$question = $this->question['question'];
$questionID = $this->question['id'];
$colourHex = $this->question['colour_hex'];
$colourRGB = $this->question['colour_rgb'];

?>

<div class="flexTest" style="position: relative; width: 60%; margin: 0 auto;">
    <div id="iconChest<?php echo $questionID; ?>" class="iconChest" style="bottom: 0; right: 0;">
        <!--
        <figure style="width:100%; height:100%; margin:0;">
        <img src="../images/com_progresstool/survey/Illustrations_InitiativesLocale02.jpg" alt="yo not loading">
        </figure>
        -->
    </div>

    <div class="masterChest" style="border-color: <?php echo $colourHex; ?>;">
        <div class="masterChestHeadingChest" style="background-color: <?php echo $colourHex; ?>;">
            <h2 class="masterChestHeading" style="text-align: left; width: 75%;">
                <?php echo '[ID: ' . $questionID . '] <span id="previewQuestion">' . $question . '</span>'; ?>
            </h2>
        </div>

        <div class="optionsChest">
            <?php foreach ($this->choices as $this->choice): ?>
                <?php $choice = $this->choice['choice']; ?>
                <?php $choiceID = $this->choice['id']; ?>

                <label class="optionChest" style="--outlineColour: <?php echo $colourHex; ?>; --optionColour: <?php echo $colourHex; ?>;">
                    <input class="optionInput" type="checkbox">
                    <span class="optionLabel" style="--labelColour: <?php echo $colourRGB; ?>;">
                        <span class="option" id="previewChoice<?php echo $this->choice['id'];?>">
                            <?php echo $choice; ?>
                        </span>
                    </span>
                </label>

            <?php endforeach; ?>
        </div>
    </div>
</div>
