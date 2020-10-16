<?php defined('_JEXEC') or die;

$id = $this->project->id;
$title = $this->project->name;
$description = $this->project->description;
$type = $this->project->type;
$alt = $this->projectCount % 2 == 0 ? 2 : 0;

?>


<div class="projectChest" id="<?php echo $id; ?>">

    <div class="projectDetails" style="order: <?php echo $alt; ?>;">
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

    <div class="gap"></div>

    <div class="buttonChest" style="order: <?php echo $alt == 2 ? 0 : 2; ?>;">
        <button class="surveyButton" onclick="window.location = `?option=com_progresstool&view=survey&projectID=${<?php echo $id;?>}`">
            Survey
        </button>
        <button class="metricsButton" onclick="window.location = `?option=com_progresstool&view=projectstats&projectID=${<?php echo $id;?>}`">
            Metrics
        </button>
        <button class="settingsButton" onclick="window.location = `?option=com_progresstool&view=settings&projectID=${<?php echo $id;?>}`">
            Settings
        </button>
    </div>

</div>