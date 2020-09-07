<?php

defined('_JEXEC') or die;

$index = $this->count;
$task = $this->task->task;
$colourHex = $this->category->colour_hex;
$criteria_met = $this->task->criteria_met;
$isChecked = $criteria_met == 1 ? '<span class="icon-ok"></span>' : '';

?>

<div class="taskChest">

    <div class="task">
        <?php echo $task; ?>
    </div>

    <div class="box" style="border-color: <?php echo $colourHex; ?>;">
        <?php echo $isChecked; ?>
    </div>

</div>
