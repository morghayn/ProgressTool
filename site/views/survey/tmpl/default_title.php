<?php defined('_JEXEC') or die; ?>

<div class="headC">

    <button onclick="window.location = '?option=com_progresstool&view=projectboard'" class="buttonBack">
        Back
    </button>

    <div class="titlC">
        <div class="titl">
            Project: <?php echo $this->project['name']; ?>
        </div>
    </div>

</div>

<p class="introductionParagraph">
    Please select all answer options that apply to your project, feel free to choose more than one option.
    <br><br>
    The choices associated with a question will collapse when it is considered complete. Choices associated with a question that have collapsed can be
    accessed again by simply clicking on the question.
</p>