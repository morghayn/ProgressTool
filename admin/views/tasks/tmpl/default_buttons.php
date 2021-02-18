<?php defined('_JEXEC') or die; ?>

<!-- Logic -->
<div id="buttons" class="buttons">
    <button class="addChoice" onclick="openChoiceSelector()">Add Choice</button>

    <div class="logicToggle">
        <button <?php echo($this->task->logic_id == 0 ? 'class="active"' : ''); ?>>OR</button>
        <button <?php echo($this->task->logic_id == 1 ? 'class="active"' : ''); ?>>AND</button>
    </div>
</div>