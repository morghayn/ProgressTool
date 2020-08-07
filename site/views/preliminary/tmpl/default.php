<?php defined('_JEXEC') or die; ?>

<!-- TODO -- Edit CSS -- Add more info button -- Check if all buttons have been checked via JavaScript -->

<?php foreach ($this->questions as $question): ?>
    <div class="box">
        <div class="page_toggle">
            <label class="toggle">
                <input class="toggle_input" type="checkbox">
                <span class="toggle_label">
                        <span class="toggle_text"><?php echo $question->question; ?></span>
                    </span>
            </label>
        </div>
    </div>
<?php endforeach; ?>

<!-- TODO change names -->
<div class="button-box">
    <button href="something" class="test">Help</button>
    <div class="space"></div>
    <button href="something" class="test" disabled>Verify Project</button>
</div>