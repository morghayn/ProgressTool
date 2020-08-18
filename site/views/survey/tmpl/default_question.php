<?php

defined('_JEXEC') or die;

$questionCounter = $this->questionCounter;
$question = $this->question->question;
$questionID = $this->question->id;
$colourHex = $this->colourHex;

?>

<div class="masterChest" style="border-color: <?php echo $colourHex; ?>">

    <div class="headingChest" style="background-color: <?php echo $colourHex; ?>;">
        <div class="heading">
            <?php echo $questionCounter . '. ' . $question; ?>
        </div>
    </div>

    <div class="optionsChest">

        <?php

        foreach ($this->choices[$questionID] as $this->choice):
            echo $this->loadTemplate('option');
        endforeach;

        ?>

    </div>

</div>
