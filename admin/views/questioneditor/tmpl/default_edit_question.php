<?php

defined('_JEXEC') or die;
$questionID = $this->question->id;
$question = $this->question->question;
$colourHex = $this->question->colour_hex;
$formRedirect = 'index.php?option=com_progresstool&view=questionEditor&task=questionEditor.updateQuestion';

?>

<div class="formChest" style="border-color: <?php echo $colourHex; ?>">
    <div class="formChestHeadingChest" style="background-color: <?php echo $colourHex; ?>" onclick="toggleQuestionForm()">
        <h1 class="formChestHeading">
            Question
        </h1>
    </div>

    <form action="<?php echo $formRedirect; ?>" method="post" class="questionForm" id="questionForm" enctype="multipart/form-data">
        <input id="token" type="hidden" name="<?php echo JSession::getFormToken(); ?>" value="1"/>
        <input type="hidden" name="questionID" value="<?php echo $questionID; ?>">

        <div class="formSlot">
            <label for="question<?php echo $questionID; ?>">[ID: <?php echo $questionID; ?>] Question</label>
            <textarea
                    id="question<?php echo $questionID; ?>"
                    oninput="updatePreview('previewQuestion', this.value)"
                    name="question"
                    rows="2"
                    maxlength="255"
            ><?php echo $question; ?></textarea>
        </div>
    </form>

    <div class="formButtonChest" id="questionFormButtonChest">
        <input type="submit" value="Submit" form="questionForm"/>
    </div>
</div>