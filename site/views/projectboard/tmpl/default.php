<?php defined('_JEXEC') or die; ?>

<!-- TODO -- Retrieve dummy user project data -- Code ability to create new project -->

<?php $projectCreateRedirect = 'onclick="location.href = \'index.php?option=com_progresstool&view=projectcreate\';"'; ?>

<div class="pb-container">
    <h2>ProjectBoard</h2>
    <?php foreach ($this->user_projects as $user_project): ?>
        <button class="button"><?php echo $user_project->name; ?></button>
        <br>
    <?php endforeach; ?>
    <button <?php echo $projectCreateRedirect; ?> class="button button2">Create New Project</button>
</div>

<a href="<?php echo $this->redirect;?>">click to login and redirect to survey</a>