<?php

defined('_JEXEC') or die;

$index = $this->count;
$goal = $this->progressGoal->goal;

?>

<!--<div class="optionChest" style="margin: 0 0 0 0;">-->
<div class="test">
    <div class="one">
        <?php echo $index . '. ' . $goal; ?>
    </div>
    <div class="two">
        <?php echo ($this->progressGoal->id % 2 ? "----" : "Done"); ?>
    </div>
</div>