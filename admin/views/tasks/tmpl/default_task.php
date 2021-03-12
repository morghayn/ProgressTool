<?php defined('_JEXEC') or die; ?>

<div id="<?php echo 'tid-' . $this->task->id; ?>" class="task" style="--colourHex: <?php echo $this->colourHex; ?>">

    <!-- Heading -->
    <div class="heading" style="--colourHex: <?php echo $this->colourHex; ?>" onclick="toggleTask()">
        <h2>TID:<?php echo $this->task->id; ?></h2>
        <h1 id="task" contenteditable="true"><?php echo $this->task->task; ?></h1>
    </div>

    <!-- Choices -->
    <div class="task-choices" style="--colourHex: <?php echo $this->colourHex; ?>">
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
                    <?php $taskChoiceID = 't-cid-' . $this->task->id . '-' . $choice->id; ?>
                    <?php $removeTaskChoiceID = 'r-t-c-' . $this->task->id . '-' . $choice->id; ?>

                    <tr id="<?php echo $taskChoiceID; ?>">
                        <td><?php echo $choice->id; ?></td>
                        <td><?php echo $choice->weight; ?></td>
                        <td><?php echo $choice->choice; ?></td>
                        <td>
                            <button id="<?php echo $removeTaskChoiceID; ?>">Remove</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Logic Toggles -->
    <div class="task-buttons">
        <?php $addChoice = 'a-t-c-' . $this->task->id; ?>
        <button class="addChoice" id="<?php echo $addChoice; ?>">Add Choice</button>

        <div class="logicToggle">
            <?php $orLogicID = 'u-t-l-0-' . $this->task->id; ?>
            <?php $andLogicID = 'u-t-l-1-' . $this->task->id; ?>
            <button <?php echo($this->task->logic_id == 0 ? 'class="active"' : ''); ?> id="<?php echo $orLogicID; ?>">OR</button>
            <button <?php echo($this->task->logic_id == 1 ? 'class="active"' : ''); ?> id="<?php echo $andLogicID; ?>">AND</button>
        </div>
    </div>

</div>