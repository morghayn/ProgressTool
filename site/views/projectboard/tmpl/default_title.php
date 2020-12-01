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
    attachEventListeners();
</script>
