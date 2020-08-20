<?php

defined('_JEXEC') or die;

$index = $this->count;
$measurement = $this->measurement[$this->category->id]->measurement;

?>

<div class="optionChest" style="margin: 0 auto;">
    <?php echo $index . '. ' . $measurement; ?>
</div>