<?php

defined('_JEXEC') or die;

$questionCounter = $this->questionCounter;
$question = $this->question->question;
$questionID = $this->question->id;
$score = $this->question->total;
$colourHex = $this->colourHex;

// For Icon
$filepath = $this->question->filepath;
$imageAttributes = $filepath ? $this->question->image_attributes : '';

$userScore = 0;
foreach ($this->choices[$questionID] as $choice):
    $userScore += is_null($choice->project_id) ? 0 : $choice->weight;
endforeach;
$chestContentDisplay = ($userScore == $score ? 'none' : 'block');

?>

<div class="masterChest" style="border-color: <?php echo $colourHex; ?>">

    <div class="masterChestHeadingChest" style="background-color: <?php echo $colourHex; ?>;" onclick="toggleChestContent('<?php echo $questionID; ?>')">
        <h2 class="masterChestHeading">
            <?php echo $questionCounter . '. ' . $question; ?>
        </h2>
        <h2 class="scoreBox">
            Score <span id="score_<?php echo $questionID; ?>"><?php echo $userScore; ?></span>/<?php echo $score; ?>
        </h2>
    </div>

    <div id="chestContent_<?php echo $questionID; ?>" style="display: <?php echo $chestContentDisplay; ?>">
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
