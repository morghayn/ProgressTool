<?php defined('_JEXEC') or die; ?>

<form action="<?php echo JRoute::_('index.php?option=com_progresstool&view=imagetest'); ?>"
      method="post" class="projectForm" enctype="multipart/form-data" style="width:35%;">

    <label>
        bottom:
        <input type="number" name="bottom" value="0" onclick="updateIconBottom(<?php echo $this->question->id;?>, this.value)">
    </label>
    <label>
        right:
        <input type="number" name="right" value="0" onclick="updateIconRight(<?php echo $this->question->id;?>, this.value)">
    </label>
</form>