<?php

defined('_JEXEC') or die;

$id = $this->project->id;
$title = $this->project->name;
$description = $this->project->description;

?>

<div class="projectChest">
    <div class="projectDetails">
        <div class="projectTitle">
            <?php echo $title; ?>
        </div>
        <div class="projectCategory">
            Hydro-electric
        </div>
        <div class="projectDescription">
            <?php echo $description; ?>
        </div>
    </div>

    <div class="buttonChest">
        <button class="surveyButton" onclick="surveyRedirect(<?php echo $id; ?>)">
            Survey
        </button>
        <button class="metricsButton" onclick="statsRedirect(<?php echo $id; ?>)">
            Metrics
        </button>
        <button class="settingsButton" onclick="statsRedirect(<?php echo $id; ?>)">
            Settings
        </button>
    </div>
</div>