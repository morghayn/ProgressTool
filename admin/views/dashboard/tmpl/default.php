<?php

defined('_JEXEC') or die;

$fragments = array(
    'Pools',
    'Categories',
    'Tasks',
    'Projects',
    'Metrics',
);

?>

<div class="fragmentContainer">
    <?php foreach ($fragments as $fragment): ?>
        <a href="?option=com_progresstool&view=<?php echo $fragment; ?>">
                <?php echo $fragment; ?>
        </a>
    <?php endforeach; ?>
</div>
