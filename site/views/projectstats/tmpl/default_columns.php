<?php defined('_JEXEC') or die; ?>

<p class="introductionParagraph">
    The lists below show the tasks divided between each heading from the <a href="/timeline">ECCO timeline</a>, <b class="people">People</b>,
    <b class="technology">Technology</b> and <b class="finance">Finance</b>. The tasks that have been completed by your Community Group are marked as
    green. To collapse the lists click on the title box.
</p>

<div class="superChest">

    <?php foreach ($this->categories as $category): ?>
        <div class="todoChest" style="border-color: <?php echo $category->colour_hex; ?>">
            <button class="category" style="background-color: <?php echo $category->colour_hex; ?>;"
                    onclick="toggleDisplay('taskList_<?php echo $category->id; ?>')">
                <?php echo $category->category; ?>
                <span>(<?php echo $this->categoryCompletionPercent[$category->id - 1]; ?>%)</span>
            </button>

            <div class="taskChest" id="taskList_<?php echo $category->id; ?>" style="display: block;">

                <?php foreach ($this->tasks[$category->id] as $task): ?>
                    <div class="taskChest">
                        <div class="task">
                            <?php echo $task->task; ?>
                        </div>
                        <div class="box" style="border-color: <?php echo $category->colour_hex; ?>;">
                            <?php echo $task->criteria_met == 1 ? '<span class="icon-ok"></span>' : ''; ?>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>
    <?php endforeach; ?>

</div>