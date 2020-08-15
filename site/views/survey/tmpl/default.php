<?php defined('_JEXEC') or die; ?>

<?php // TODO: Is this the correct setup for tokens? ?>
<?php echo '<input id="token" type="hidden" name="' . JSession::getFormToken() . '" value="1" />'; ?>

<div class="masterChest" style="background-color: #668cff; border-color: #668cff;">

    <!-- Question -->
    <div class="titleChest" style="background-color: #668cff;">
        <div class="title">
            Project Name: <?php echo $this->projectName; ?>
        </div>
    </div>

</div>

<?php foreach ($this->surveyQuestions as $question): ?>
    <?php if($question->id == 16) continue; ?>
    <?php $this->questionCounter++; ?>
    <?php $colour_hex = $question->colour_hex; ?>
    <?php $colour_rgb = $question->colour_rgb; ?>

    <!-- Question Box -->
    <div class="masterChest" style="border-color: <?php echo $colour_hex; ?>">

        <!-- Question -->
        <div class="titleChest" style="background-color: <?php echo $colour_hex; ?>;">
            <div class="title">
                <?php echo $this->questionCounter . '. ' . $question->question; ?>
            </div>
        </div>

        <!-- Choices -->
        <div class="optionsChest">
            <?php foreach ($this->choices[$question->id] as $choice): ?>
                <?php $isChecked = is_null($choice->project_id) ? "" : "checked"; ?> <!-- TODO: Replace with join with project_choice and choice -->
                <?php $clickEvent = 'id="' . $choice->id . '" onclick="checker(' . $this->projectID . ',' . $choice->id . ')"'; ?> <!-- can i not just send checker(this) and get id?-->

                <?php /** Debug
                 * var_dump($clickEvent);
                 * var_dump($isChecked);
                 */ ?>

                <?php echo '<label class="optionChest" style=" --outlineColour:' . $colour_hex . '; --optionColour:' . $colour_hex . ';">'; ?>
                <input class="optionInput" type="checkbox" <?php echo $clickEvent . ' ' . $isChecked ?>>
                <span class="optionLabel" style="--labelColour: <?php echo 'rgba(' . $colour_rgb . ', 0.10);'; ?>">
                    <span class="option">
                        <?php echo $choice->choice; ?>
                    </span>
                </span>
                </label>
            <?php endforeach; ?>
        </div>

    </div>
<?php endforeach; ?>
