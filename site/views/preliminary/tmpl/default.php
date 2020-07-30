<?php defined('_JEXEC') or die; ?>

<!---
    -- Edit CSS
    -- Add more info button
    -- Check if all buttons have been checked via JavaScript
---->

<?php foreach ($this->questions as $question): ?>
    <div class="box">
        <h2 style="color: white;background-color: black;"><?php echo $question->question; ?></h2>
    </div>
<?php endforeach; ?>