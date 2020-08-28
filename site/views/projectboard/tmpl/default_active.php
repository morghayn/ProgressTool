<?php defined('_JEXEC') or die;

$id = $this->project->id;
$title = $this->project->name;
$description = $this->project->description;
$type = $this->project->type;
$alt = $this->projectCount % 2 == 0 ? 2 : 1;

?>

<div class="projectContainer">

    <div class="projectChest">

        <div class="projectDetails" style="order: <?php echo $alt;?>;">
            <div class="projectTitle">
                <?php echo $title; ?>
            </div>
            <div class="projectType">
                <?php echo $type; ?>
            </div>
            <div class="projectDescription">
                <?php echo $description; ?>
            </div>
        </div>

        <div class="buttonChest" style="order: <?php echo $alt == 2 ? 1 : $alt;?>;">
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