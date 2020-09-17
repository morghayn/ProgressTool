<?php

defined('_JEXEC') or die;
$questionID = $this->question['id'];
$colourHex = $this->question['colour_hex'];
$formRedirect = 'index.php?option=com_progresstool&view=questionEditor&task=questionEditor.updateIcon';

?>

<div class="formChest" style="border-color: <?php echo $colourHex; ?>">
    <div class="formChestHeadingChest" style="background-color: <?php echo $colourHex; ?>" onclick="toggleIconForm()">
        <h1 class="formChestHeading">
            Icon
        </h1>
    </div>

    <form action="<?php echo $formRedirect; ?>" method="post" class="iconForm" id="iconForm" enctype="multipart/form-data">
        <input id="token" type="hidden" name="<?php echo JSession::getFormToken(); ?>" value="1"/>
        <input type="file" name="imageToUpload" id="imageToUpload">

        <div class="formSlot">
            <label for="bottom">Bottom Offset</label>
            <input id="bottom" name="bottom" type="number" value="0" onclick="updateIconBottom(<?php echo $questionID; ?>, this.value)"/>
        </div>

        <div class="formSlot">
            <label for="right">Right Offset</label>
            <input id="right" name="right" type="number" value="0" onclick="updateIconRight(<?php echo $questionID; ?>, this.value)"/>
        </div>
    </form>

    <div class="formButtonChest" id="iconFormButtonChest">
        <input type="submit" value="Submit" form="questionForm"/>
        <button onclick="removeIcon(<?php echo $questionID; ?>)">Remove Image</button>
    </div>
</div>