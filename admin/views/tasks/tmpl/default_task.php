<?php defined('_JEXEC') or die; ?>

<div id="<?php echo $this->taskID; ?>" class="task" onclick="openTaskEditor(this.id)" style="border-color: <?php echo $this->colourHex; ?>">

    <!-- Heading -->
    <div class="heading" style="background-color: <?php echo $this->colourHex; ?>">
        <h2>TID:<?php echo $this->task->id; ?></h2>
        <h1 id="task" contenteditable="true"><?php echo $this->task->task; ?></h1>
    </div>

    <!-- Editor -->
    <div class="editor">

        <div id="choices" class="choices">
            <h1>Criteria: <?php echo $this->task->criteria; ?></h1>
            <h1>Choices</h1>

            <?php foreach ($this->task->choices as $this->choice): ?>
                <?php $this->choiceID = 'choiceid-' . $this->choice->id; ?>

                <div id="<?php echo $this->choiceID; ?>" class="choice">
                    <button onclick="removeChoice('<?php echo $this->task->id . "','" . $this->choice->id; ?>')">
                        Remove
                    </button>
                    <h3 id="<?php echo $this->choice->id; ?>">CID:<?php echo $this->choice->id; ?></h3>
                    <h2><?php echo $this->choice->choice; ?></h2>
                </div>
            <?php endforeach; ?>

            <div class="buttons">
                <button class="add">Add Choice</button>
                <button class="save">Save</button>
            </div>
        </div>

    </div>
</div>

<!-- For testing purposes -->
<!--<button onclick="buildTaskObject('<?php //echo $this->taskid; ?>')">Test buildTaskObject()</button>-->
