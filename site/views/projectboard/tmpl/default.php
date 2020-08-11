<?php defined('_JEXEC') or die; ?>

    <!-- TODO -- Retrieve dummy user project data -- Code ability to create new project -->
<?php echo '<input id="token" type="hidden" name="' . JSession::getFormToken() . '" value="1" />'; ?>
<?php $createRedirect = 'onclick="location.href = \'index.php?option=com_progresstool&view=projectcreate\';"'; ?>

    <div class="masterChest" style="background-color: #668cff; border-color: #668cff; width: 95%; border-radius: 3px;">

        <!-- Heading -->
        <div class="titleChest" style="background-color: #668cff;">
            <div class="title">
                ProjectBoard
            </div>
        </div>

    </div>

<?php foreach ($this->projects as $project): ?>
    <?php $colour = '#668cff'; ?>
    <?php $surveyRedirect = 'onclick="surveyRedirect(\'' . $project->id . '\')"'; ?>
    <?php $preliminaryStyle = 'style=" --outlineColour: ' . $colour . '; --optionColour: ' . $colour . '"'; ?>

    <!-- Question Box -->
    <div class="masterChest" style="border-color: <?php echo $colour; ?>">

        <!-- Question -->
        <div class="titleChest" style="background-color: <?php echo $colour; ?>;">
            <div class="title">
                <?php echo $project->name;
                if ($project->activated == 0) {
                    echo "\t[not activated]";
                }
                ?>
            </div>
        </div>

        <!-- Options -->
        <div class="optionsChest">
            <?php if ($project->activated == 1): ?>

                <!---
				<div class="projectInfo">
					<div class="half">Project Name:</div>
					<div class="half"><?php echo $project->name; ?></div>
				</div>
				--->
                <div class="projectInfo">
                    <div class="half">Project Description:</div>
                    <div class="half2"><?php echo $project->description; ?></div>
                </div>

                <!--<button class="button" <?php //echo $surveyRedirect; ?>>Update Progress</button>-->
                <div class="preliminaryButtonChest">
                    <button class="preliminaryButton" <?php echo $surveyRedirect; ?>>Update Progress</button>
                </div>

            <?php else: ?>

                <?php foreach ($this->preliminaryQuestions as $question): ?>
                    <?php $clickEvent = 'onclick="preliminaryClick(' . $project->id . ',' . $question->id . ')"' ?>
                    <?php $id = 'id="' . $project->id . $question->id . '"'; ?>


                    <label class="optionChest" <?php echo $preliminaryStyle; ?>>
                        <input class="optionInput" <?php echo $clickEvent; ?> type="checkbox">
                        <span class="optionLabel">
                        <span class="option">
                            <?php echo $question->question; ?>
                        </span>
                    </span>
                    </label>

                <?php endforeach; ?>

                <div class="preliminaryButtonChest">
                    <button href="something" class="preliminaryButton">Helpful Resources</button>
                </div>

            <?php endif; ?>
        </div>


    </div>
<?php endforeach; ?>

    <div class="masterChest" style="border: none; width: 45%;">
        <button <?php echo $createRedirect; ?> class="button button2">
            Create New Project
        </button>
    </div>
    <!--<div class="pb-container"></div>--->
<?php //$colour = "#" . $question->colour; ?>
<?php //list($r, $g, $b) = sscanf($colour, "#%02x%02x%02x"); ?>