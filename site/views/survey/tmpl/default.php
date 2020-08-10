<?php defined('_JEXEC') or die; ?>

<?php // TODO: Is this the correct setup for tokens? ?>
<?php echo '<input id="token" type="hidden" name="' . JSession::getFormToken() . '" value="1" />'; ?>

<div class="masterChest" style="background-color: #668cff; border-color: #668cff; width: 95%; border-radius: 3px;">

    <!-- Question -->
    <div class="titleChest" style="background-color: #668cff;">
        <div class="title">
            <?php echo $this->projectName; ?>
        </div>
    </div>

</div>

<?php foreach ($this->surveyQuestions as $question): ?>
    <?php $colour = "#" . $question->colour; ?>
    <?php list($r, $g, $b) = sscanf($colour, "#%02x%02x%02x"); ?>

    <!-- Question Box -->
    <div class="masterChest" style="border-color: <?php echo $colour; ?>">

        <!-- Question -->
        <div class="titleChest" style="background-color: <?php echo $colour; ?>;">
            <div class="title">
                <?php echo $question->id . '. ' . $question->question; ?>
            </div>
        </div>

        <!-- Choices -->
        <div class="optionsChest">
            <?php foreach ($this->choices[$question->id] as $choice): ?>
                <?php $isChecked = (in_array($choice->id, $this->selections) ? "checked" : ""); ?>
                <?php $clickEvent = 'id="' . $choice->id . '" onclick="checker(' . $this->projectID . ',' . $choice->id . ')"'; ?> <!-- can i not just send checker(this) and get id?-->

                <?php /** Debug
                 * var_dump($clickEvent);
                 * var_dump($isChecked);
                 */ ?>

                <?php echo '<label class="optionChest" style=" --outlineColour:' . $colour . '; --optionColour:' . $colour . ';">'; ?>
                <input class="optionInput" type="checkbox" <?php echo $clickEvent . ' ' . $isChecked ?>>
                <span class="optionLabel" style="--labelColour: rgba(<?php echo "{$r}, {$g}, {$b}"; ?>, 0.10);">
                    <span class="option">
                        <?php echo $choice->choice; ?>
                    </span>
                </span>
                </label>

            <?php endforeach; ?>
        </div>

    </div>
<?php endforeach; ?>
