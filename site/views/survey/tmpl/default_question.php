<?php

defined('_JEXEC') or die;

$questionCounter = $this->questionCounter;
$question = $this->question->question;
$questionID = $this->question->id;
$score = $this->question->total;
$colourHex = $this->colourHex;

$userScore = 0;
foreach ($this->choices[$questionID] as $choice):
    $userScore += is_null($choice->project_id) ? 0 : $choice->weight;
endforeach;

?>

<div class="masterChest" style="border-color: <?php echo $colourHex; ?>">

    <div class="masterChestHeadingChest" style="background-color: <?php echo $colourHex; ?>;" onclick="opensesame('<?php echo 'cC' . $questionID; ?>')">
        <h2 class="masterChestHeading">
            <?php echo $questionCounter . '. ' . $question; ?>
        </h2>
        <h2 class="scoreBox">
            Score <span id="score_<?php echo $questionID; ?>"><?php echo $userScore; ?></span>/<?php echo $score; ?>
        </h2>
    </div>

    <div id="cC<?php echo $questionID; ?>" class="contentChest" style="display: <?php echo $userScore == $score ? 'none' : 'block';?>">
        <div class="optionsChest">

            <?php
            foreach ($this->choices[$questionID] as $this->choice):
                echo $this->loadTemplate('option');
            endforeach;
            ?>

        </div>
    </div>

    <input type="submit" value="Submit">
</div>
