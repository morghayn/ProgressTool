<?php

defined('_JEXEC') or die;
JHtml::_('behavior.formvalidator');

?>

<button onclick="printVal()">
    hmmm
</button>

<form action="<?php echo JRoute::_('index.php?option=com_progresstool&view=dashboard'); ?>"
      method="post" name="adminForm" id="adminForm" class="projectForm" enctype="multipart/form-data" style="width:35%;">

    <div class="form-horizontal">
        <fieldset class="adminform">
            <!--<legend><?php //echo JText::_('COM_HELLOWORLD_LEGEND_DETAILS') ?></legend>-->
            <?php echo $this->form->renderFieldset('imageadd');  ?>
        </fieldset>
    </div>

    <div class="buttonChest">
        <button type="button" class="buttonCancel" onclick="Joomla.submitbutton('projectcreate.cancel')">
            <span class="icon-cancel"></span><?php echo JText::_('JCANCEL') ?>
        </button>

        <button type="button" class="buttonSubmit" onclick="Joomla.submitbutton('projectcreate.save')">
            <span class="icon-ok"></span><?php echo JText::_('JSAVE') ?>
        </button>
    </div>

    <input type="hidden" name="task" />
    <?php echo JHtml::_('form.token'); ?>
</form>