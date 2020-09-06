<?php defined('_JEXEC') or die; ?>

<div class="fragmentContainer">
    <?php foreach ($this->projects as $project): ?>
        <a href="?option=com_progresstool&view=project&project=<?php echo $project->id; ?>">
            <?php echo '(' . $project->user_id . ') : '; ?>
            <?php echo $project->name; ?>
        </a>
    <?php endforeach; ?>
</div>