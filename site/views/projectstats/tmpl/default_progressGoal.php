<?php

defined('_JEXEC') or die;

$index = $this->count;
$goal = $this->progressGoal->goal;

?>

<div class="optionChest" style="margin: 0 0 0 0;">
    <?php echo $index . '. ' . $goal; ?>
</div>