<?php

defined('_JEXEC') or die;
$questionID = $this->question['id'];
$question = $this->question['question'];
$colourHex = $this->question['colour_hex'];

?>

<!-- Question Editor -->
<div class="formChest" style="border-color: <?php echo $colourHex; ?>">
    <div class="formChestHeadingChest" style="background-color: <?php echo $colourHex; ?>"
         onclick="toggleDisplay('questionForm', 'questionFormButtonChest')">
        <h1 class="formChestHeading">
            Question
        </h1>
    </div>

    <form action="<?php echo JRoute::_('index.php?option=com_progresstool&view=questionEditor&task=questionEditor.updateQuestion'); ?>"
          method="post" class="questionForm" id="questionForm" enctype="multipart/form-data">

        <input type="hidden" name="questionID" value="<?php echo $questionID; ?>">

        <div class="formSlot">
            <label for="question<?php echo $questionID; ?>">[ID: <?php echo $questionID; ?>] Question</label>
            <textarea
                    id="question<?php echo $questionID; ?>"
                    oninput="updatePreview('previewQuestion', this.value)"
                    name="question"
                    rows="1"
                    maxlength="255"
            ><?php echo $question; ?></textarea>
        </div>

    </form>

    <div class="formButtonChest" id="questionFormButtonChest">
        <input type="submit" value="Submit" form="questionForm"/>
    </div>
</div>