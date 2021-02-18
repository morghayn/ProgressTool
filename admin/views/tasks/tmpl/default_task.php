<?php defined('_JEXEC') or die; ?>

<div id="<?php echo 'taskid-' . $this->task->id; ?>" class="task" style="--colourHex: <?php echo $this->colourHex; ?>">

    <!-- Heading -->
    <div class="heading" style="--colourHex: <?php echo $this->colourHex; ?>"
         onclick="toggleTaskEditor('<?php echo 'taskid-' . $this->task->id; ?>')">
        <h2>TID:<?php echo $this->task->id; ?></h2>
        <h1 id="task" contenteditable="true"><?php echo $this->task->task; ?></h1>
    </div>

    <!-- Editor -->
    <?php echo $this->loadTemplate('choices'); ?>
    <?php echo $this->loadTemplate('buttons'); ?>
</div>