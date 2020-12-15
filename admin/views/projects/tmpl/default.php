<?php defined('_JEXEC') or die; ?>

<input id="token" type="hidden" name="<?php echo JSession::getFormToken(); ?>" value="1"/>

<div class="fragmentContainer">
    <?php foreach ($this->projects as $project): ?>
        <div class="project">
            <?php echo '(' . $project->user_id . ') : '; ?>
            <?php echo $project->name; ?>
        </div>
        <button onclick="deleteProject(<?php echo $project->id; ?>)">
            Delete
        </button>
    <?php endforeach; ?>
</div>