<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php JHtml::_('behavior.formvalidator'); ?>
<?php echo $this->loadTemplate('heading'); ?>

<form action="<?php echo JRoute::_('index.php?option=com_progresstool&view=settings'); ?>"
      method="post" name="adminForm" id="adminForm" class="projectForm" enctype="multipart/form-data">

    <div class="form-horizontal">
        <h1>Project Details</h1>
        <fieldset class="adminform">
            <?php echo $this->form->renderFieldset('details'); ?>
            <button type="button" class="submitButton" onclick="Joomla.submitbutton('settings.update')">
                Update project details
            </button>
        </fieldset>
    </div>

    <input type="hidden" name="task"/>
    <?php echo JHtml::_('form.token'); ?>
</form>

<div class="dangerZone">
    <h1>Danger Zone</h1>
    <div class="dangerContainer">
        <p>
            <b>Delete this project</b><br>Your project no longer accessible should you choose to delete it.
        </p>
        <button onclick="alert('This is not yet working. This feature will be implemented by Monday.')">
            Delete this project
        </button>
    </div>
</div>