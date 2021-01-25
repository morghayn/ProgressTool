<?php defined('_JEXEC') or die; ?>

<div class="project" id="<?php echo $this->project->id; ?>">

    <div class="details" style="order: <?php echo $this->count % 2 ? 0 : 2; ?>;">
        <h1><?php echo $this->project->name; ?></h1>
        <h2><?php echo $this->project->type; ?></h2>
        <p><?php echo $this->project->description; ?></p>
    </div>

    <div class="buttons" style="order: <?php echo $this->count % 2 ? 2 : 0; ?>;">
        <button class="survey" onclick="window.location = `?option=com_progresstool&view=survey&projectID=${<?php echo $this->project->id; ?>}`">
            Survey
        </button>
        <button class="metrics" onclick="window.location = `?option=com_progresstool&view=metrics&projectID=${<?php echo $this->project->id; ?>}`">
            Metrics
        </button>
        <button class="settings" onclick="window.location = `?option=com_progresstool&view=settings&projectID=${<?php echo $this->project->id; ?>}`">
            Settings
        </button>
    </div>

</div>