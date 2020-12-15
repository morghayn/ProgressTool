<?php defined('_JEXEC') or die; ?>

<input id="token" type="hidden" name="<?php echo JSession::getFormToken(); ?>" value="1"/>

<script>
    function deleteProject(projectID)
    {
        let token = jQuery("#token").attr("name")

        jQuery.ajax(
            {
                type: 'POST',
                data: {[token]: "1", task: "projects.delete", format: "json", projectID: projectID},
                success: (result) =>
                {
                    if (result.data === true)
                    {
                        console.log(result.projectID)
                    }
                },
                error: () => console.log('Failure to perform affirm(). Contact an dashboard if this failure persists.'),
            }
        )
    }
</script>

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