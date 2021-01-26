<?php defined('_JEXEC') or die; ?>

<form id="<?php echo $this->taskid; ?>" class="task">
    <div class="heading" style="background-color: <?php echo $this->colourHex; ?>">
        <h2>ID:<?php echo $this->task->id; ?></h2>
        <h1><?php echo $this->task->task; ?></h1>
    </div>
</form>

