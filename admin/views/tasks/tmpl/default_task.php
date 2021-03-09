<?php defined('_JEXEC') or die; ?>

<div id="<?php echo 'taskid-' . $this->task->id; ?>" class="task" style="--colourHex: <?php echo $this->colourHex; ?>" onmouseover="focusTask(this.id)">

    <!-- Heading -->
    <div class="heading" style="--colourHex: <?php echo $this->colourHex; ?>" onclick="toggleTaskEditor()">
        <h2>TID:<?php echo $this->task->id; ?></h2>
        <h1 id="task" contenteditable="true"><?php echo $this->task->task; ?></h1>
    </div>

    <!-- Choices -->
    <div id="choices" style="--colourHex: <?php echo $this->colourHex; ?>">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Weight</th>
                    <th>Choice</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($this->task->choices as $choice): ?>
                    <tr id="<?php echo 'choiceid-' . $choice->id; ?>" onmouseover="focusChoice(this.id)">
                        <td><?php echo $choice->id; ?></td>
                        <td><?php echo $choice->weight; ?></td>
                        <td><?php echo $choice->choice; ?></td>
                        <td>
                            <button onclick="removeChoice()">Remove</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Logic Toggles -->
    <div id="buttons" class="buttons">
        <button class="addChoice" onclick="openChoiceSelector()">Add Choice</button>

        <div class="logicToggle" id="logicToggle">
            <button id="or" <?php echo($this->task->logic_id == 0 ? 'class="active"' : ''); ?> onclick="logicToggle('or')">OR</button>
            <button id="and" <?php echo($this->task->logic_id == 1 ? 'class="active"' : ''); ?> onclick="logicToggle('and')">AND</button>
        </div>
    </div>

</div>