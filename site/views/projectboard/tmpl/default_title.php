<?php defined('_JEXEC') or die; ?>

<div class="titleContainer" id="titleContainer">
    <button id="projectCreate">Create Project</button>
    <h1 id="title">Project Board</h1>

    <?php if ($this->projects): // Only display project selector if user has projects ?>
        <label for="projectSelect">Select Project</label>
        <select name="projectSelect" id="projectSelect">
            <option value="0">All</option>
            <?php foreach ($this->projects as $project): ?>
                <option value="<?php echo $project->id; ?>">
                    <?php echo $project->name; ?>
                </option>
            <?php endforeach; ?>
        </select>
    <?php else: // Adjusts style to accommodate the absence of project selector ?>
        <script>
            accommodateNoSelector();
        </script>
    <?php endif; ?>
</div>

<script>
    // Project create button event
    const projectCreate = document.getElementById('projectCreate');
    projectCreate.addEventListener("click", () =>
        window.location = '?option=com_progresstool&view=projectcreate'
    );

    // Project selection event
    let projectSelect = document.getElementById('projectSelect');
    projectSelect.addEventListener("change", () =>
        {
            let projectID = projectSelect.options[projectSelect.selectedIndex].value;
            if (projectID > 0)
            {
                // Display selected project
                let projectsBox = document.getElementById(`projectsBox`);
                let projectBox = document.getElementById(`projectBox`);
                projectBox.style.display = "block";
                projectsBox.style.display = "none";
                document.getElementById(`projectBox`).innerHTML = getProjectTemplate(projectID, 1);
            }
            else
            {
                // Display all projects
                window.location = '?option=com_progresstool&view=projectboard'
            }
        }
    );
</script>
