<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php JHtml::_('behavior.formvalidator'); ?>

<form action="<?php echo JRoute::_('index.php?option=com_progresstool&view=projectcreate'); ?>"
      method="post" name="adminForm" id="adminForm" class="projectForm" enctype="multipart/form-data">

    <div class="form-horizontal">
        <h1>Project Details</h1>
        <fieldset class="adminform">
            <?php echo $this->form->renderFieldset('details'); ?>
            <button type="button" class="submitButton" onclick="Joomla.submitbutton('projectcreate.save')">
                Create project
            </button>
        </fieldset>
    </div>

    <input type="hidden" name="task"/>
    <?php echo JHtml::_('form.token'); ?>
</form>