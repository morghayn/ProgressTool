<?php defined('_JEXEC') or die; ?>

<!-- Logic -->
<div id="buttons" class="buttons">
    <button class="addChoice" onclick="openChoiceSelector()">Add Choice</button>

    <div class="logicToggle" id="logicToggle">
        <button id="or" <?php echo($this->task->logic_id == 0 ? 'class="active"' : ''); ?> onclick="logicToggle('or')">OR</button>
        <button id="and" <?php echo($this->task->logic_id == 1 ? 'class="active"' : ''); ?> onclick="logicToggle('and')">AND</button>
    </div>
</div>