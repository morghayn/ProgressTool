<?php defined('_JEXEC') or die; ?>

<!-- Main -->
<div id="main">
    <?php echo $this->heading; ?>
    <?php echo $this->sidebar; ?>

    <div class="statChips">
        <div class="statChip">
            <h1><?php echo $this->selectionCount; ?></h1>
            <h2>Selection Count</h2>
        </div>

        <div class="statChip">
            <h1><?php echo $this->projectCount; ?></h1>
            <h2>Project Count</h2>
        </div>

        <div class="statChip">
            <h1><?php echo $this->activatedCount; ?></h1>
            <h2>Activated Project Count</h2>
        </div>

        <div class="statChip">
            <h1><?php echo $this->deactivatedCount; ?></h1>
            <h2>Deactivated Project Count</h2>
        </div>
    </div>
</div>