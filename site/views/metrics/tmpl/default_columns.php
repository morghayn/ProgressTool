<?php defined('_JEXEC') or die; ?>

<div class="taskColumns" id="taskColumns">
    <?php foreach ($this->categories as $category): ?>
        <div class="taskColumn" style="border-color: <?php echo $category->colour_hex; ?>">

            <!-- category used as task column heading -->
            <button class="taskCategory"
                    style="background-color: <?php echo $category->colour_hex; ?>;"
                    onclick="toggleDisplay('t-l-<?php echo $category->id; ?>')">
                <?php echo $category->category; ?>
                <span>(<?php echo $this->progress[$category->id - 1]; ?>%)</span>
            </button>

            <!-- category task list -->
            <div class="taskList" id="<?php echo 't-l-' . $category->id; ?>">
                <?php foreach ($this->tasks[$category->id] as $task): ?>
                    <div class="task">
                        <p><?php echo $task->task; ?></p>
                        <div class="taskCheckbox" style="border-color: <?php echo $category->colour_hex; ?>;">
                            <?php echo $task->criteria_met == 1 ? '<span class="icon-ok"></span>' : ''; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>
    <?php endforeach; ?>
</div>