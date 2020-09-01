<?php

defined('_JEXEC') or die;

$questionCounter = $this->questionCounter;
$question = $this->question->question;
$questionID = $this->question->id;
$colourHex = $this->question->colour_hex;

?>

<div class="flexTest" style="position: relative; width: 60%; margin: 0 auto;">
    <div id="iconChest<?php echo $this->question->id;?>" class="iconChest" style="position: absolute; width: 200px; height: 200px; bottom: 0; right: 0;">
        <figure style="width:100%; height:100%; margin:0;">
        <img src="../images/com_progresstool/survey/Illustrations_InitiativesLocale02.jpg" alt="yo not loading">
        </figure>
    </div>

    <div class="masterChest" style="border-color: <?php echo $colourHex; ?>; margin-bottom: 0;">

        <div class="headingChest" style="background-color: <?php echo $colourHex; ?>;">
            <h2 class="heading" style="text-align: left; width: 75%;"><?php echo $questionCounter . '. ' . $question; ?></h2>
        </div>

        <div class="contentChest">
            <div class="optionsChest">

                <?php
                foreach ($this->choices[$questionID] as $this->choice):
                    echo $this->loadTemplate('option');
                endforeach;
                ?>

            </div>

        </div>

    </div>
</div>
