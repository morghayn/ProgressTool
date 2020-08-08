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
                    <?php $isChecked = in_array($choice->id, $this->dirtyImp) ? "checked" : ""; ?>
                    <?php $clickEvent = 'onclick=checker(' . $choice->id . ')" id="' . $choice->id . '"'; ?>
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
</div>