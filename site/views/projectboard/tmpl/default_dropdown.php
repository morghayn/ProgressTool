<?php

defined('_JEXEC') or die;

?>

<p class="introductionParagraph">
    <b style="color: red">!!! Create new project and settings is currently heavily in work-in-progress. !!!</b>
</p>

<div class="projectSelection">
    <h2>
        Select Project
    </h2>

    <select onchange="this.options[this.selectedIndex].value > 0 ? showSpecific(this.options[this.selectedIndex].value) : showAll()">
        <option value="0">
            All
        </option>

        <?php foreach ($this->projects as $project): ?>
            <option value="<?php echo $project->id; ?>">
                <?php echo $project->name; ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>