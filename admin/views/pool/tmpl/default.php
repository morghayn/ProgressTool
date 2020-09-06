<?php defined('_JEXEC') or die; ?>

<div class="fragmentContainer">

    <?php foreach ($this->questions as $question): ?>

        <div style="background-color: <?php echo $question->colour_hex; ?>">
            <?php echo $question->question; ?>
        </div>

        <?php foreach ($this->choices[$question->id] as $choice): ?>
            <div style="background-color: whitesmoke; color: black;">
                <?php echo $choice->choice; ?>
            </div>
        <?php endforeach; ?>

    <?php endforeach; ?>

</div>

