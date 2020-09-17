<?php

defined('_JEXEC') or die;
$questionID = $this->question['id'];
$colourHex = $this->question['colour_hex'];
$formRedirect = 'index.php?option=com_progresstool&view=questionEditor&task=questionEditor.updateQuestionChoices';

?>

<div class="formChest" style="border-color: <?php echo $colourHex; ?>">
    <div class="formChestHeadingChest" style="background-color: <?php echo $colourHex; ?>" onclick="toggleQuestionChoiceForm()">
        <h1 class="formChestHeading">
            Choices
        </h1>
    </div>

    <form action="<?php echo $formRedirect; ?>" method="post" class="questionChoiceForm" id="questionChoiceForm" enctype="multipart/form-data">
        <?php foreach ($this->choices as $choice): ?>

            <?php $choiceID = $choice['id']; ?>
            <div class="formSlot">
                <label for="choice<?php echo $choiceID; ?>">[ID: <?php echo $choiceID; ?>] Choice</label>

                <textarea id="choice<?php echo $choiceID; ?>"
                          name="choices[<?php echo $choiceID; ?>][choice]"
                          oninput="updatePreview('previewChoice<?php echo $choiceID; ?>', this.value)"
                          rows="1"
                          maxlength="255"
                ><?php echo $choice['choice']; ?></textarea>

                <input name="choices[<?php echo $choiceID; ?>][weight]" type="text" value="<?php echo $choice['weight']; ?>"/>

                <button type="button" onclick="deleteChoice(<?php echo $choiceID; ?>)">
                    X
                </button>
            </div>

        <?php endforeach; ?>
    </form>

    <div class="formButtonChest" id="questionChoiceFormButtonChest">
        <input type="submit" value="Submit" form="questionChoiceForm"/>
        <button onclick="addChoice(<?php echo $questionID; ?>)">Add New</button>
        <!--<button>Add Existing</button>-->
    </div>
</div>