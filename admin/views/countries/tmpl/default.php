<?php defined('_JEXEC') or die; ?>

<!-- Main -->
<div id="main">
    <?php echo $this->heading; ?>
    <?php echo $this->sidebar; ?>

    <div class="navigationFragments">
        <div class="fragment">
            <h1 class="fragmentHeader">Countries</h1>
            <?php foreach ($this->countries as $country): ?>
                <div class="child">
                    <h1><?php echo $country->country; ?></h1>
                    <a href="?option=com_progresstool&view=questions&countryID=<?php echo $country->id; ?>">Questions</a>
                    <a href="?option=com_progresstool&view=tasks&countryID=<?php echo $country->id; ?>">Tasks</a>
                </div>
            <?php endforeach; ?>
            <a class="create" href="">Create New</a>
        </div>
    </div>
</div>