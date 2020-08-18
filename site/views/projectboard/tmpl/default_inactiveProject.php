<?php

defined('_JEXEC') or die;

$id = $this->project->id;
$name = $this->project->name;
$description = $this->project->description;

?>

<div class="masterChest">

    <div class="headingChest">
        <div class="heading"><?php echo $name; ?> :: Not Activated</div>
    </div>

    <div class="optionsChest">

        <?php foreach ($this->approvalQuestions as $question): ?>
            <label class="optionChest" style="--outlineColour: #3d4d85; --optionColour: #3d4d85;">
                <input class="optionInput" onclick="approvalClick(<?php echo $id . ',' . $question->id; ?>)" type="checkbox">
                <span class="optionLabel" style="--labelColour: 61, 77, 133;">
                    <span class="option"><?php echo $question->question; ?></span>
                </span>
            </label>
        <?php endforeach; ?>

        <div class="approvalButtonChest">
            <button href="something" class="approvalButton">Helpful Resources</button>
        </div>
    </div>
</div>