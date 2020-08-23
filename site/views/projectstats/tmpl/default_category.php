<?php

defined('_JEXEC') or die;

$category = $this->category;
$name = $category->category;
$colourHex = $category->colour_hex;
$colourRGB = $category->colour_rgb;

?>

<div class="todoChest" style="border-color: <?php echo $colourHex; ?>">

    <div class="headingChest" style="background-color: <?php echo $colourHex; ?>; cursor: pointer;" onclick="opensesame('taskList_<?php echo $this->category->id; ?>')">
        <div class="heading"><?php echo $name; ?></div>
    </div>

    <div class="taskChest" id="taskList_<?php echo $this->category->id; ?>" style="display: none;">
        <?php
        $this->count = 0;
        foreach ($this->tasks[$this->category->id] as $this->task):
            $this->count++;
            echo $this->loadTemplate('task');
        endforeach;
        ?>
    </div>

</div>
