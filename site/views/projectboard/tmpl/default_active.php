<?php

defined('_JEXEC') or die;

$id = $this->project->id;
$name = $this->project->name;
$description = $this->project->description;

?>

<div class="testChest">

    <!--
    <div class="projectTitle">
        <div class="heading"><?php //echo $name; ?></div>
    </div>
    -->

    <div class="projectChest">
        <div class="projectInfo">
            <div class="half">Project Description</div>
            <div class="half2"><?php echo $description; ?></div>
        </div>

        <div class="buttonsChest">
            <div class="approvalButtonChest">
                <button class="approvalButton" onclick="surveyRedirect(<?php echo $id; ?>)">
                    Survey
                </button>
            </div>

            <div class="approvalButtonChest">
                <button class="approvalButton" onclick="statsRedirect(<?php echo $id; ?>)" style="background-color: cornflowerblue;">
                    Statistics
                </button>
            </div>

            <div class="approvalButtonChest">
                <button class="approvalButton" onclick="statsRedirect(<?php echo $id; ?>)" style="background-color: gray;">
                    Settings
                </button>
            </div>
        </div>
    </div>

</div>