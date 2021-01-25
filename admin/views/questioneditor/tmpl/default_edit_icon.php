<?php

defined('_JEXEC') or die;
$questionID = $this->question->id;
$colourHex = $this->question->colour_hex;
$formRedirect = "index.php?option=com_progresstool&view=questionEditor&task=questionEditor.updateIcon&questionID=$questionID";
$filepath = $this->question->filepath;
$width = $filepath ? $this->question->width : 200;
$height = $filepath ? $this->question->height : 200;
$rightOffset = $filepath ? $this->question->right_offset : 0;
$bottomOffset = $filepath ? $this->question->bottom_offset : 0;

?>

<div class="formChest" style="border-color: <?php echo $colourHex; ?>">
    <div class="formChestHeadingChest" style="background-color: <?php echo $colourHex; ?>" onclick="toggleIconForm()">
        <h1 class="formChestHeading">
            Icon
        </h1>
    </div>

    <form action="<?php echo $formRedirect; ?>" method="post" class="iconForm" id="iconForm" enctype="multipart/form-data">
        <input id="token" type="hidden" name="<?php echo JSession::getFormToken(); ?>" value="1"/>
        <!--<input type="file" name="icon" id="icon">-->
        <?php if (!$filepath): ?>
            <input type="file" name="file_upload">
        <?php else: ?>

            <div class="formSlot">
                <label for="bottom">Bottom Offset</label>
                <input
                        id="bottom"
                        name="icon[bottom]"
                        type="number"
                        value="<?php echo $bottomOffset; ?>"
                        onchange="updateIconBottom(this.value)"
                />
            </div>

            <div class="formSlot">
                <label for="right">Right Offset</label>
                <input
                        id="right"
                        name="icon[right]"
                        type="number"
                        value="<?php echo $rightOffset; ?>"
                        onchange="updateIconRight(this.value)"
                />
            </div>

            <div class="formSlot">
                <label for="widthToggle">Width</label>
                <input
                        id="widthToggle"
                        name="icon[width]"
                        type="number"
                        value="<?php echo $width; ?>"
                        onchange="updateIconWidth()"
                />
            </div>

            <div class="formSlot">
                <label for="heightToggle">Height</label>
                <input
                        id="heightToggle"
                        name="icon[height]"
                        type="number"
                        value="<?php echo $height; ?>"
                        onchange="updateIconHeight()"
                />
            </div>

        <?php endif; ?>
    </form>

    <?php if ($filepath): ?>
        <label for="lockIconAspectRation">Lock Aspect Ratio</label><input type="checkbox" id="lockIconAspectRation" checked/>
    <?php endif; ?>

    <div class="formButtonChest" id="iconFormButtonChest">
        <input type="submit" value="Submit" form="iconForm"/>
        <button onclick="deleteIcon(<?php echo $questionID; ?>)">Remove Image</button>
    </div>
</div>