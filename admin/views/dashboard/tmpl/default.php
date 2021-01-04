<?php defined('_JEXEC') or die; ?>
<?php $fragments = array('Categories', 'Tasks', 'Projects', 'Metrics'); ?>

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


    <div class="fragment">
        <h1>Question Pools</h1>

        <?php foreach ($this->pools as $pool): ?>
            <div class="child">
                <a href="?option=com_progresstool&view=pool&pool=<?php echo $pool->id; ?>">
                    <?php echo $pool->country; ?>
                </a>
            </div>
        <?php endforeach; ?>

        <div class="child">
            <a href="" style="background-color: lightseagreen;">
                Create New
            </a>
        </div>
    </div>
</div>