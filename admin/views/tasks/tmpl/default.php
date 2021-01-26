<?php defined('_JEXEC') or die; ?>

<!-- Main -->
<div id="main">
    <?php echo $this->heading; ?>
    <?php echo $this->sidebar; ?>

    <div class="tasks">
        <?php foreach ($this->tasks as $this->task): ?>
            <?php $this->colourHex = $this->categories[--$this->task->category_id]->colour_hex; ?>
            <?php $this->taskid = 'taskid-' . $this->task->id; ?>

            <?php echo $this->loadTemplate('task'); ?>
        <?php endforeach; ?>
    </div>
</div>

<!-- CSRF Token -->
<input id="token" type="hidden" name="<?php echo JSession::getFormToken(); ?>" value="1"/>
