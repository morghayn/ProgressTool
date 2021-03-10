<?php defined('_JEXEC') or die; ?>

<!-- Main -->
<div id="main">
    <?php echo $this->heading; ?>
    <?php echo $this->sidebar; ?>
    <?php echo $this->loadTemplate('modal'); ?>

    <div class="tasks">
        <?php foreach ($this->tasks as $this->task): ?>
            <?php $this->colourRGB = $this->categories[$this->task->category_id - 1]->colour_rgb; ?>
            <?php $this->colourHex = $this->categories[$this->task->category_id - 1]->colour_hex; ?>
            <?php echo $this->loadTemplate('task'); ?>
            <?php //break; ?>
        <?php endforeach; ?>
    </div>
</div>

<!-- CSRF Token -->
<input id="token" type="hidden" name="<?php echo JSession::getFormToken(); ?>" value="1"/>

<!-- Initializing countryID -->
<script>countryID = <?php echo $this->countryID; ?></script>