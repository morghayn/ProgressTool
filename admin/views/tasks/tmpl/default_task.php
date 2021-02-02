<?php defined('_JEXEC') or die; ?>

<div id="<?php echo $this->taskID; ?>" class="task" onclick="openTaskEditor(this.id)" style="border-color: <?php echo $this->colourHex; ?>">

    <!-- Heading -->
    <div class="heading" style="background-color: <?php echo $this->colourHex; ?>">
        <h2>TID:<?php echo $this->task->id; ?></h2>
        <h1 id="task" contenteditable="true"><?php echo $this->task->task; ?></h1>
    </div>

    <!-- Editor -->
    <div class="editor">

        <h1>Criteria: <?php echo $this->task->criteria; ?></h1>

        <h1>Logic</h1>
        <div class="choices">
            <label class="choice" style="--outlineColour: <?php echo $this->colourHex; ?>; --optionColour: <?php echo $this->colourHex; ?>;">
                <input type="checkbox" <?php echo ($this->task->logic_id == 0 ? 'checked' : '');?>>
                <span class="box" style="--labelColour: <?php echo $this->colourRGB; ?>;">
                    <span class="text">OR</span>
                </span>
            </label>
            <label class="choice" style="--outlineColour: <?php echo $this->colourHex; ?>; --optionColour: <?php echo $this->colourHex; ?>;">
                <input type="checkbox" <?php echo ($this->task->logic_id == 1 ? 'checked' : '');?>>
                <span class="box" style="--labelColour: <?php echo $this->colourRGB; ?>;">
                    <span class="text">AND</span>
                </span>
            </label>
        </div>


        <h1>Choices</h1>
        <div id="choices" class="choices">
            <?php foreach ($this->task->choices as $this->choice): ?>
                <?php $this->choiceID = 'choiceid-' . $this->choice->id; ?>

                <div id="<?php echo $this->choiceID; ?>" class="choice item" style="border-color: <?php echo $this->colourHex; ?>">
                    <h3 id="<?php echo $this->choice->id; ?>">CID:<?php echo $this->choice->id; ?></h3>
                    <h3>W:<?php echo $this->choice->weight; ?></h3>
                    <button onclick="removeChoice('<?php echo $this->task->id . "','" . $this->choice->id; ?>')">Remove</button>
                    <h2><?php echo $this->choice->choice; ?></h2>
                </div>
            <?php endforeach; ?>

            <button class="add" onclick="openModal()">Add Choice</button>
        </div>

    </div>
</div>

<!-- For testing purposes -->
<!--<button onclick="buildTaskObject('<?php //echo $this->taskid; ?>')">Test buildTaskObject()</button>-->
