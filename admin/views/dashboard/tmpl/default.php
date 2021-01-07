<?php defined('_JEXEC') or die; ?>
<?php $fragments = array('Categories', 'Tasks', 'Projects', 'Metrics', 'Pools'); ?>

<div class="navigationFragments">
    <div class="fragment">
        <h1>Settings</h1>
        <?php foreach ($fragments as $fragment): ?>
            <div class="child">
                <a href="?option=com_progresstool&view=<?php echo $fragment; ?>">
                    <?php echo $fragment; ?>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>