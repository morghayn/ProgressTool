<?php

defined('_JEXEC') or die;

$projectID = $this->project->id;
$question = $this->question->question;
$questionID = $this->question->id;

?>

<label class="optionChest" style="--outlineColour: #ffffff; --optionColour: #ffffff;">

    <input class="optionInput" onclick="approvalClick(<?php echo $projectID . ',' . $questionID . ',' . $this->projectCount; ?>)" type="checkbox">

    <span class="optionLabel" style="--labelColour: 255, 255, 255; color: #ffffff;">
        <span class="option" style="color: #ffffff;"><?php echo $question; ?></span>
    </span>

</label>