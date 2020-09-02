<?php

defined('_JEXEC') or die;

$fragments = array(
    'metrics',
    'pools',
    'projects',
    'settings',
    'tasks'
);

?>

<?php
echo '<pre>';
var_dump($this->test);
 echo '</pre>';
 ?>

<div class="fragments">
    <?php foreach ($fragments as $fragment): ?>
        <a class="fragment" href="?option=com_progresstool&view=<?php echo $fragment; ?>">
            <span>
                <?php echo $fragment; ?>
            </span>
        </a>
    <?php endforeach; ?>
</div>
