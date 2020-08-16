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
    <?php $colour_hex = $question->colour_hex; ?>
    <?php $colour_rgb = $question->colour_rgb; ?>

    <div class="masterChest" style="border-color: <?php echo $colour_hex; ?>">

        <div class="titleChest" style="background-color: <?php echo $colour_hex; ?>;">
            <div class="title">
                <?php echo $this->questionCounter . '. ' . $question->question; ?>
            </div>
        </div>

        <div class="optionsChest">
            <?php foreach ($this->choices[$question->id] as $choice): ?>
                <?php $clickEvent = 'id="' . $choice->id . '" onclick="checker(' . $this->projectID . ',' . $choice->id . ')"'; ?>

                <label class="optionChest" style="<?php echo '--outlineColour:' . $colour_hex . '; --optionColour:' . $colour_hex; ?>;">
                    <input class="optionInput" type="checkbox" <?php echo $clickEvent . (is_null($choice->project_id) ? "" : " checked") ?>>
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
