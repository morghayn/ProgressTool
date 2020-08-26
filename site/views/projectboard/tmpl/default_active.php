<?php

defined('_JEXEC') or die;

$id = $this->project->id;
$title = $this->project->name;
$description = $this->project->description;

$detailsOrder = 1;
$buttonsOrder = 2;

if ($this->projectCount % 2 == 0)
{
    $detailsOrder = 2;
    $buttonsOrder = 1;
}

?>

<div class="projectContainer">

    <div class="projectChest">

        <div class="projectDetails" style="order: <?php echo $detailsOrder;?>;">
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

        <div class="buttonChest" style="order: <?php echo $buttonsOrder;?>;">
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
</div>