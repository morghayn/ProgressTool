<?php defined('_JEXEC') or die; ?>

<!-- Main -->
<div id="main">
    <?php echo $this->heading; ?>
    <?php echo $this->sidebar; ?>

    <div style="width: 100%; margin: 2rem 0; display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 1rem;">
        <button onclick="openAllTaskEditors()">Open All Task Editors</button>
        <button onclick="closeAllTaskEditors()">Close All Task Editors</button>
    </div>

    <div class="tasks">
        <?php foreach ($this->tasks as $this->task): ?>
            <?php $this->colourHex = $this->categories[--$this->task->category_id]->colour_hex; ?>
            <?php $this->taskID = 'taskid-' . $this->task->id; ?>
            <?php echo $this->loadTemplate('task'); ?>
        <?php endforeach; ?>
    </div>
</div>

<!-- CSRF Token -->
<input id="token" type="hidden" name="<?php echo JSession::getFormToken(); ?>" value="1"/>
