<?php defined('_JEXEC') or die; ?>
<?php $fragments = array('Categories', 'Tasks', 'Projects', 'Metrics'); ?>

<div class="fragCon">
    <div class="fragmentContainer">
        <h1>Settings</h1>
        <?php foreach ($fragments as $fragment): ?>
            <div class="child">
                <img src="<?php echo JURI::root() . '/media/com_progresstool/icons/stwigc.png'; ?>" alt="->">
                <a href="?option=com_progresstool&view=<?php echo $fragment; ?>">
                    <?php echo $fragment; ?>
                </a>
            </div>
        <?php endforeach; ?>
    </div>


    <div class="fragmentContainer">
        <h1>Question Pools</h1>

        <?php foreach ($this->pools as $pool): ?>
            <div class="child">
                <img src="<?php echo JURI::root() . '/media/com_progresstool/icons/stwigc.png'; ?>" alt="->">
                <a href="?option=com_progresstool&view=pool&pool=<?php echo $pool->id; ?>">
                    <?php echo $pool->country; ?>
                </a>
            </div>
        <?php endforeach; ?>

        <div class="child">
            <img src="<?php echo JURI::root() . '/media/com_progresstool/icons/stwigce.png'; ?>" alt="->">
            <a href="" style="background-color: lightseagreen;">
                Create New
            </a>
        </div>
    </div>
</div>