<?php

defined('_JEXEC') or die;

$id = $this->project->id;
$name = $this->project->name;
$description = $this->project->description;

?>

<div class="masterChest">

    <div class="headingChest">
        <div class="heading"><?php echo $name; ?></div>
    </div>

    <div class="optionsChest">
        <div class="projectInfo">
            <div class="half">Project Description</div>
            <div class="half2"><?php echo $description; ?></div>
        </div>

        <div class="approvalButtonChest">
            <button class="approvalButton" onclick="surveyRedirect(<?php echo $id; ?>)">
                Update Progress
            </button>
        </div>
    </div>

</div>