<?php defined('_JEXEC') or die; ?>

<div class="headingChest">
    <button onclick="window.location = '?option=com_progresstool&view=projectboard'" class="buttonBack">
        Back
    </button>
    <button onclick="window.location = `?option=com_progresstool&view=projectstats&projectID=${<?php echo $this->projectID; ?>}`" class="buttonMetrics">
        Metrics
    </button>
    <div class="headingChestTitleChest">
        <div class="headingChestTitle">
            Progress Survey
        </div>
    </div>
</div>

<p class="introductionParagraph">
    This survey is used to measure the development of a project under each heading of
    <b class="people">People</b>, <b class="technology">Technology</b> and <b class="finance">Finance</b>.
    The results are shown in ‘<a href="?option=com_progresstool&view=projectstats&projectID=<?php echo $this->projectID; ?>">Metrics</a>’,
    which will indicate which areas the project is progressing in and show what steps to take next.
    <br><br>
    Please select all answer options that apply to your project, feel free to choose more than one option. You do not need to answer every question in
    this survey, the results will be calculated from the given answers.
    <br><br>
    The choices associated with a question will collapse when it is considered complete, these can be accessed again by clicking on the question.
</p>