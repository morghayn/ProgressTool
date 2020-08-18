<?php

defined('_JEXEC') or die;

$projectID = $this->project->id;
$question = $this->question->question;
$questionID = $this->question->id;

?>

<label class="optionChest" style="--outlineColour: #3d4d85; --optionColour: #3d4d85;">

    <input class="optionInput" onclick="approvalClick(<?php echo $projectID . ',' . $questionID; ?>)" type="checkbox">

    <span class="optionLabel" style="--labelColour: 61, 77, 133;">
        <span class="option"><?php echo $question; ?></span>
    </span>

</label>