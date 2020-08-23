<?php

defined('_JEXEC') or die;

$index = $this->count;
$task = $this->task->task;
$colourHex = $this->category->colour_hex;

?>

<div class="taskChest">
    <div class="task">
        <?php echo $task; //$index . '. ' . $task; ?>
    </div>
    <div class="box" style="border-color: <?php echo $colourHex; ?>">
    </div>
</div>
