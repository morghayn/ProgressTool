<?php defined('_JEXEC') or die; ?>

<div class="fragmentContainer">
    <?php foreach ($this->pools as $pool): ?>
        <a href="?option=com_progresstool&view=pool&pool=<?php echo $pool->id; ?>">
            <?php echo $pool->country; ?>
        </a>
    <?php endforeach; ?>
</div>
