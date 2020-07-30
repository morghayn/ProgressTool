<?php defined('_JEXEC') or die; ?>

<?php foreach ($this->questions as $question): ?>
    <div class="box" style="background-color: #<?php echo $question->primary; ?>;">
        <h2 style="color: white;background-color: #<?php echo $question->secondary; ?>;"><?php echo $question->id . '. ' . $question->question; ?></h2>
        <?php foreach ($this->question_choices[$question->id] as $choice): ?>
            <div class="page_toggle">
                <label class="toggle" style="--toggleColor: #<?php echo $question->secondary; ?>;">
                    <input class="toggle_input" type="checkbox">
                    <span class="toggle_label">
                        <span class="toggle_text"><?php echo $choice->choice; ?></span>
                    </span>
                </label>
            </div>
        <?php endforeach; ?>
    </div>
<?php endforeach; ?>