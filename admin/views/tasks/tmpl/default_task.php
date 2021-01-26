<?php defined('_JEXEC') or die; ?>

<div id="<?php echo $this->taskid; ?>" class="task" onclick="openTaskEditor(this.id)" style="border-color: <?php echo $this->colourHex; ?>">
    <div class="heading" style="background-color: <?php echo $this->colourHex; ?>">
        <h2>ID:<?php echo $this->task->id; ?></h2>
        <h1 id="task" contenteditable="true"><?php echo $this->task->task; ?></h1>
    </div>
    <div class="editor">
        <!-- Work in progress -->
        <button onclick="buildTaskObject('<?php echo $this->taskid; ?>')">Test buildTaskObject()</button>
    </div>
</div>
