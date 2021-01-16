<?php defined('_JEXEC') or die;

$id = $this->project->id;
$title = $this->project->name;
$description = $this->project->description;
$type = $this->project->type;
$alt = $this->projectCount % 2 == 0 ? 2 : 0;

?>


<div class="project" id="<?php echo $id; ?>">

    <div class="details" style="order: <?php echo $alt; ?>;">
        <div class="title"><?php echo $title; ?></div>
        <div class="type"><?php echo $type; ?></div>
        <div class="description"><?php echo $description; ?></div>
    </div>

    <div class="buttons" style="order: <?php echo $alt == 2 ? 0 : 2; ?>;">
        <button class="survey"
                onclick="window.location = `?option=com_progresstool&view=survey&projectID=${<?php echo $id;?>}`">
            Survey</button>
        <button class="metrics"
                onclick="window.location = `?option=com_progresstool&view=metrics&projectID=${<?php echo $id;?>}`">
            Metrics</button>
        <button class="settings"
                onclick="window.location = `?option=com_progresstool&view=settings&projectID=${<?php echo $id;?>}`">
            Settings</button>
    </div>

</div>