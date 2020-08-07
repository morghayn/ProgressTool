<?php defined('_JEXEC') or die; ?>

<!-- TODO -- Retrieve dummy user project data -- Code ability to create new project -->


<div class="pb-container">
    <h2>ProjectBoard</h2>
    <?php foreach ($this->user_projects as $user_project): ?>
        <button class="button"><?php echo $user_project->name; ?></button>
        <br>
    <?php endforeach; ?>
    <button class="button button2">Create New Project</button>
</div>

<br>
<br>
<br>
<br>


<a href="<?php echo $this->redirect;?>">click to login and redirect to survey</a>


<!-- TODO change example names and then remove after testing -->
<div id="searchmap">
    <?php echo '<input id="token" type="hidden" name="' . JSession::getFormToken() . '" value="1" />'; ?>
    <button type="button" class="btn btn-primary" onclick="searchHere();">
        Click to Return Information
    </button>
    <div id="searchresults">
    </div>
</div>