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

    <div class="headingChest" style="background-color: <?php echo $colourHex; ?>;" onclick="opensesame('<?php echo 'cC' . $questionID; ?>')">
        <h2 class="heading" style="text-align: left; width: 75%;"><?php echo $questionCounter . '. ' . $question; ?></h2>
        <!-- TODO: Put into CSS file -->
        <h2 style="font-weight: 600; box-sizing: border-box; border: 2px solid white; text-align: center; width: 70px; margin: auto 10px auto auto; font-size: 1.20em; line-height: 1; padding: 3px;">
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

</div>
