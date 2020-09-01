<?php defined('_JEXEC') or die; ?>

<p class="introductionParagraph">
    The lists below show the tasks divided between each heading from the <a href="/test">ECCO timeline</a>, <b class="people">People</b>,
    <b class="technology">Technology</b> and <b class="finance">Finance</b>. The tasks that have been completed by your Community Group are marked as
    green. To collapse the lists click on the title box.
</p>

<div class="superChest">

    <?php foreach ($this->categories as $this->category):
        $category = $this->category;
        $name = $category->category;
        $colourHex = $category->colour_hex;
        $colourRGB = $category->colour_rgb; ?>

        <div class="todoChest" style="border-color: <?php echo $colourHex; ?>">

            <div class="headingChest" style="background-color: <?php echo $colourHex; ?>; cursor: pointer;"
                 onclick="opensesame('taskList_<?php echo $this->category->id; ?>')">
                <div class="heading"><?php echo $name; ?></div>
            </div>

            <div class="taskChest" id="taskList_<?php echo $this->category->id; ?>" style="display: block;">
                <?php
                $this->count = 0;
                foreach ($this->tasks[$this->category->id] as $this->task):
                    $this->count++;
                    echo $this->loadTemplate('task');
                endforeach;
                ?>
            </div>

        </div>

    <?php endforeach; ?>

</div>
