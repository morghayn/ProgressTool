<?php defined('_JEXEC') or die; ?>

<?php $colour = "#ff6666"; ?>

<?php echo '<input id="token" type="hidden" name="' . JSession::getFormToken() . '" value="1" />'; ?>

<!-- Question Box -->
<div class="masterChest" style="border-color: <?php echo $colour; ?>">

    <!-- Title -->
    <div class="titleContainer" style="background-color: <?php echo $colour; ?>;">
        <div class="title">
            <?php echo "Project Creation"; ?>
        </div>
    </div>

    <!-- Form -->
    <div class="fieldChest">
        <label class="labelChest">Project Name</label>
        <input class="textBox" type="text" name="projectName" placeholder="Name" id="name" />

        <label class="labelChest">Project Description</label>
        <input class="textBox" type="text" name="projectDescription" placeholder="Description" id="description" />
    </div>

    <div class="buttonBox">
        <button href="something" class="button" onclick="createProject()">create project</button>
        <!---todo implement functionality disabled--->
    </div>

</div>