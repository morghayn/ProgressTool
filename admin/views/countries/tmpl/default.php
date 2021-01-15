<?php defined('_JEXEC') or die; ?>

<?php echo $this->loadTemplate('sidebar'); ?>

<div id="main">
    <span class="openNavigation" onclick="openNav()">&#9776; navigation</span>

    <div class="navigationFragments">
        <div class="fragment">
            <h1 class="fragmentHeader">Countries</h1>

            <?php foreach ($this->pools as $pool): ?>
                <div class="child">
                    <h1><?php echo $pool->country; ?></h1>
                    <a href="?option=com_progresstool&view=questions&pool=<?php echo $pool->id; ?>">Questions</a>
                    <a href="?option=com_progresstool&view=tasks&pool=<?php echo $pool->id; ?>">Tasks</a>
                </div>
            <?php endforeach; ?>

            <a class="create" href="">Create New</a>
        </div>
    </div>
</div>