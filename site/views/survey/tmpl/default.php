<?php defined('_JEXEC') or die; ?>

<?php // TODO: Is this the correct setup for tokens? ?>
<?php echo '<input id="token" type="hidden" name="' . JSession::getFormToken() . '" value="1" />'; ?>

<div class="masterChest">

    <!-- Question -->
    <div class="titleChest">
        <div class="title">
            Project Name: <?php echo $this->projectName; ?>
        </div>
    </div>

</div>

<!-- TODO input finish button when questionCounter = 16 -->
<?php foreach ($this->surveyQuestions as $question): ?>
    <?php $this->questionCounter++; ?>

    <div class="masterChest" style="border-color: <?php echo $question->colour_hex; ?>">

        <div class="titleChest" style="background-color: <?php echo $question->colour_hex; ?>;">
            <div class="title">
                <?php echo $this->questionCounter . '. ' . $question->question; ?>
            </div>
        </div>

        <div class="optionsChest">
            <?php foreach ($this->choices[$question->id] as $choice): ?>
                <?php $clickEvent = 'id="' . $choice->id . '" onclick="checker(' . $this->projectID . ',' . $choice->id . ')"'; ?>

                <label class="optionChest" style="--outlineColour: <?php echo $question->colour_hex; ?>; --optionColour: <?php echo $question->colour_hex; ?>;">
                    <input class="optionInput" type="checkbox" <?php echo $clickEvent . (is_null($choice->project_id) ? "" : " checked") ?>>
                    <span class="optionLabel" style="--labelColour: <?php echo $question->colour_rgb; ?>;">
                        <span class="option">
                            <?php echo $choice->choice; ?>
                        </span>
                    </span>
                </label>
            <?php endforeach; ?>
        </div>

    </div>
<?php endforeach; ?>
