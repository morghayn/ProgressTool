<?php defined('_JEXEC') or die; ?>

<style>
    /** Overriding Joomla's CSS */
    body, .container-main, #system-debug {
        padding: 0;
    }
    .navbar-fixed-top, .navbar-fixed-bottom {
        position: fixed;
    }
    .navbar, .collapse {
        margin: 0 auto;
        width: 100%;
    }
</style>

<div class="sidebar">
    <?php for ($i = 0; $i < 5; $i++) { ?>
        <div class="sidebarSection">
            <p>Hello World</p>
        </div>
    <?php } ?>
</div>

<div class="questions">
    <?php foreach ($this->questions as $question): ?>
        <?php $colour = "#" . $question->secondary; ?>
        <?php list($r, $g, $b) = sscanf($colour, "#%02x%02x%02x"); ?>

        <!-- Question Box -->
        <div class="questionChoiceContainer" style="border-color: <?php echo $colour; ?>">

            <!-- Question -->
            <div class="questionContainer" style="background-color: <?php echo $colour; ?>;">
                <div class="question">
                    <?php echo $question->id . '. ' . $question->question; ?>
                </div>
            </div>

            <!-- Choices -->
            <div class="choicesContainer">
                <?php foreach ($this->choices[$question->id] as $choice): ?>
                    <?php $isChecked = in_array($choice->id, $this->dirtyImp) ? "checked" : ""; ?>
                    <?php $clickEvent = "onclick=\"checker({$choice->id})\" id=\"{$choice->id}\""; ?>
                    <label class="choiceContainer"
                           style="--outlineColour: <?php echo $colour; ?>; --choiceColour: <?php echo $colour; ?>;">
                        <input class="choiceInput" type="checkbox" <?php echo $clickEvent . ' ' . $isChecked ?>>
                        <span class="choiceLabel"
                              style="--labelColour: rgba(<?php echo "{$r}, {$g}, {$b}"; ?>, 0.10);">
                            <span class="choice">
                                <?php echo $choice->choice; ?>
                            </span>
                        </span>
                    </label>

                <?php endforeach; ?>
            </div>

        </div>
    <?php endforeach; ?>
</div>