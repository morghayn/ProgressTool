<?php defined('_JEXEC') or die; ?>

<!-- TODO -- Check if all buttons have been checked via JavaScript -->


<!--
<p>
    If you have any uncertainties to any of these questions... it's highly recommend to click the helpful resources
    button
</p>
-->

<?php $colour = "#ff6666"; ?>

<!-- Question Box -->
<div class="projectActivationContainer" style="border-color: <?php echo $colour; ?>">

    <!-- Title -->
    <div class="titleContainer" style="background-color: <?php echo $colour; ?>;">
        <div class="title">
            <?php echo "Project Activation"; ?>
        </div>
    </div>

    <!-- Questions -->
    <div class="questionsContainer">
        <?php foreach ($this->questions as $question): ?>
            <label class="questionContainer"
                   style="--outlineColour: <?php echo $colour; ?>; --choiceColour: <?php echo $colour; ?>;">
                <input class="questionInput" type="checkbox">
                <span class="questionLabel">
                    <span class="question">
                        <?php echo $question->question; ?>
                    </span>
                </span>
            </label>
        <?php endforeach; ?>
    </div>

    <div class="buttonBox">
        <button href="something" class="button">helpful resources</button>
        <button href="something" class="button" disabled>activate project</button>
    </div>
</div>