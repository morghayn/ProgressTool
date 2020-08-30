<?php defined('_JEXEC') or die; ?>

<?php echo '<input id="token" type="hidden" name="' . JSession::getFormToken() . '" value="1" />'; ?>

<div class="projectForm">

    <label for="name">Project Name</label>
    <input type="text" placeholder="Project Name" id="name"/>


    <label for="description">Project Description</label>
    <textarea placeholder="Project Description" id="description"></textarea>


    <label for="type">Choose a project type:</label>
    <select id="type" name="type">
        <?php foreach ($this->projectTypes as $projectType): ?>
            <option value="<?php echo $projectType->id; ?>">
                <?php echo $projectType->type; ?>
            </option>
        <?php endforeach; ?>
    </select>


    <div class="buttonChest">
        <button class="buttonCancel" onclick="createProject()">
            <span class="icon-cancel"></span>Cancel
        </button>

        <button class="buttonSubmit" onclick="redirectProjectBoard()">
            <span class="icon-ok"></span>Submit
        </button>
    </div>

</div>