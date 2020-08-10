<?php defined('_JEXEC') or die; ?>

<!-- TODO -- Retrieve dummy user project data -- Code ability to create new project -->
<?php echo '<input id="token" type="hidden" name="' . JSession::getFormToken() . '" value="1" />'; ?>

<?php $createRedirect = 'onclick="location.href = \'index.php?option=com_progresstool&view=projectcreate\';"'; ?>

<div class="pb-container">

    <h2>ProjectBoard</h2>

    <?php foreach ($this->projects as $project): ?>

        <?php
        //$projectID = urlencode(base64_encode(1));
        //$surveyRedirect = 'surveyRedirect(\'index.php?option=com_progresstool&view=survey&project=' . $projectID . '\')';
        //$projectID = urlencode(base64_encode(1))
        $surveyRedirect = 'surveyRedirect(\''. $project->id . '\')';
        ?>

        <button class="button" onclick="<?php echo $surveyRedirect; ?>"><?php echo $project->name; ?></button>

    <?php endforeach; ?>

    <button <?php echo $createRedirect; ?> class="button button2">Create New Project</button>

</div>

<a href="<?php echo $this->redirect; ?>">click to login and redirect to survey</a>