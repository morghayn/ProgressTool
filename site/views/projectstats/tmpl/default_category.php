<?php

defined('_JEXEC') or die;

$category = $this->category;
$name = $category->category;
$colourHex = $category->colour_hex;
$colourRGB = $category->colour_rgb;

?>

<div class="masterChest">

    <div class="headingChest" style="background-color: <?php echo $colourHex; ?>;">
        <div class="heading"><?php echo $name; ?></div>
    </div>

    <div class="optionsChest">

        <?php
        $this->count = 0;
        foreach ($this->progressGoals[$this->category->id] as $this->progressGoal):
            $this->count++;
            echo $this->loadTemplate('progress');
        endforeach;
        ?>

        <style>
            .test {
                width: 100%;
                display: flex;
                justify-content: center;
                text-align: center;
                align-items: center;
                margin: 0 0 15px 0;
            }

            .one {
                margin: 0 auto;
                width: 80%;
                padding-right: 5%;
                /**background-color: #ff6666; */
                padding-top: 0.5em;
                padding-bottom: 0.5em;
            }

            .two {
                flex: auto;
                margin: 0 auto;
                /**background-color: #66ff8c;*/
                padding-top: 0.5em;
                padding-bottom: 0.5em;
                border: 2px solid black;
            }
        </style>
    </div>

</div>
