<?php

defined('_JEXEC') or die;

$index = $this->count;
$task = $this->task->task;
$colourHex = $this->category->colour_hex;
$criteria = $this->task->criteria;
$selected = $this->task->selected;
$done = true;

if (($criteria > 1) && $criteria != $selected)
{
    $done = false;
}
else if ($selected == 0)
{
    $done = false;
}

$back = $done ? "background-color: green;" : "background-color: crimson;";

?>

<div class="taskChest">
    <div class="task">
        <?php echo $task; //$index . '. ' . $task; ?>
    </div>
    <div class="box" style="border-color: <?php echo $colourHex . ';' . $back; ?>">
    </div>
</div>
