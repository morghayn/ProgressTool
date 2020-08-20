<?php

defined('_JEXEC') or die;

$category = $this->measurementCategory;
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
        foreach ($this->measurements as $this->measurement):
            $this->count++;
            echo $this->loadTemplate('measurement');
        endforeach;
        ?>
    </div>

</div>
