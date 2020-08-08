<?php defined('_JEXEC') or die; ?>

<!--
TODO -- Check if all buttons have been checked via JavaScript
<p>
    If you have any uncertainties to any of these options... it's highly recommend to click the helpful resources
    button
</p>
-->

<?php $colour = "#ff6666"; ?>

<!-- Option Chest -->
<div class="masterChest" style="border-color: <?php echo $colour; ?>">

    <!-- Title -->
    <div class="titleChest" style="background-color: <?php echo $colour; ?>;">
        <div class="title">
            <?php echo "Activate Your Project"; ?>
        </div>
    </div>

    <!-- Options -->
    <div class="optionsChest">
        <?php foreach ($this->questions as $question): ?>
            <?php echo '<label class="optionChest" style=" --outlineColour:' . $colour . '; --optionColour:' . $colour . ';">'; ?>
            <input class="optionInput" type="checkbox">
            <span class="optionLabel">
                    <span class="option">
                        <?php echo $question->question; ?>
                    </span>
                </span>
            </label>
        <?php endforeach; ?>
    </div>

    <div class="buttonChest">
        <button href="something" class="button">helpful resources</button>
        <button href="something" class="button" disabled>activate project</button>
    </div>
</div>
