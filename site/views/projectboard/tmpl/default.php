<?php defined('_JEXEC') or die; ?>

<?php echo '<input id="token" type="hidden" name="' . JSession::getFormToken() . '" value="1" />'; ?>

<!-- Heading -->
<div class="masterChest">
    <div class="titleChest">
        <div class="title">
            ProjectBoard
        </div>
    </div>
</div>

<?php foreach ($this->projects as $project): ?>

    <!-- Question Box -->
    <div class="masterChest">

        <!-- Question -->
        <div class="titleChest">
            <div class="title">
                <?php echo $project->name . ($project->activated == 0 ? ' :: Not Activated' : ''); ?>
            </div>
        </div>

        <!-- Options -->
        <div class="optionsChest">
            <?php if ($project->activated == 1): ?>

                <div class="projectInfo">
                    <div class="half">Project Description:</div>
                    <div class="half2"><?php echo $project->description; ?></div>
                </div>

                <div class="approvalButtonChest">
                    <button class="approvalButton" onclick="surveyRedirect(<?php echo $project->id; ?>)">Update Progress</button>
                </div>

            <?php else: ?>

                <?php foreach ($this->approvalQuestions as $question): ?>
                    <?php $isChecked = ""; ?>

                    <label class="optionChest" style="--outlineColour: #3d4d85; --optionColour: #3d4d85;">
                        <input class="optionInput" onclick="approvalClick(<?php echo $project->id . ',' . $question->id;?>)" type="checkbox">
                        <span class="optionLabel" style="--labelColour: 61, 77, 133;">
                        <span class="option">
                            <?php echo $question->question; ?>
                        </span>
                    </span>
                    </label>

                <?php endforeach; ?>

                <div class="approvalButtonChest">
                    <button href="something" class="approvalButton">Helpful Resources</button>
                </div>

            <?php endif; ?>
        </div>

    </div>
<?php endforeach; ?>

<div class="masterChest" style="border: none; width: 45%;">
    <button onclick="location.href = '?option=com_progresstool&view=projectcreate'" class="button button2">
        Create New Project
    </button>
</div>