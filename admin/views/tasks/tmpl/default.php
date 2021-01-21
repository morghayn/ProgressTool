<?php defined('_JEXEC') or die; ?>

<!-- Main -->
<div id="main">
    <?php echo $this->heading; ?>
    <?php echo $this->sidebar; ?>

    <div class="tasks">
        <?php foreach ($this->tasks as $task): ?>
            <?php $colour = $this->categories[--$task->category_id]->colour_hex; ?>
            <div class="task">
                <div class="heading" style="background-color: <?php echo $colour; ?>">
                    <span class="id">ID:<?php echo $task->id; ?></span>
                    <h1><?php echo $task->task; ?></h1>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- CSRF Token -->
<input id="token" type="hidden" name="<?php echo JSession::getFormToken(); ?>" value="1"/>
