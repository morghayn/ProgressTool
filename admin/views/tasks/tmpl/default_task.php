<?php defined('_JEXEC') or die; ?>

<div id="<?php echo $this->taskid; ?>" class="task" onclick="openTaskEditor(this.id)" style="border-color: <?php echo $this->colourHex; ?>">

    <!-- Heading -->
    <div class="heading" style="background-color: <?php echo $this->colourHex; ?>">
        <h2>TID:<?php echo $this->task->id; ?></h2>
        <h1 id="task" contenteditable="true"><?php echo $this->task->task; ?></h1>
    </div>

    <!-- Editor -->
    <div class="editor">

        <!-- Work in progress -->
        <?php if (array_key_exists($this->task->id, $this->choices)): ?>
            <div id="choices" class="choices">
                <?php foreach ($this->choices[$this->task->id] as $this->choice): ?>
                    <div class="choice">
                        <button>Remove</button>
                        <h3 id="<?php echo $this->choice->id; ?>">CID:<?php echo $this->choice->id; ?></h3>
                        <h2><?php echo $this->choice->choice; ?></h2>
                    </div>
                <?php endforeach; ?>

                <div class="buttons">
                    <button class="add">Add Choice</button>
                    <button class="save">Save</button>
                </div>
            </div>
        <?php endif; ?>

    </div>
</div>

<!-- For testing purposes -->
<button onclick="buildTaskObject('<?php echo $this->taskid; ?>')">Test buildTaskObject()</button>
