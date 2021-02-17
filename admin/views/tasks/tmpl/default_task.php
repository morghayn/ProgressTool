<?php defined('_JEXEC') or die; ?>

<div id="<?php echo 'taskid-' . $this->task->id; ?>" class="task" style="border-color: <?php echo $this->colourHex; ?>">

    <!-- Heading -->
    <div class="heading" style="background-color: <?php echo $this->colourHex; ?>"
         onclick="toggleTaskEditor('<?php echo 'taskid-' . $this->task->id; ?>')">
        <h2>TID:<?php echo $this->task->id; ?></h2>
        <h1 id="task" contenteditable="true"><?php echo $this->task->task; ?></h1>
    </div>

    <!-- Editor -->
    <div class="editor">
        <?php echo $this->loadTemplate('choices'); ?>
        <?php echo $this->loadTemplate('logic'); ?>
    </div>
</div>