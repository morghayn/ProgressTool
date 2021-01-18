<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php JHtml::_('behavior.formvalidator'); ?>
<?php echo $this->loadTemplate('heading'); ?>
<?php echo $this->loadTemplate('modal'); ?>

<form action="<?php echo JRoute::_('index.php?option=com_progresstool&view=settings'); ?>"
      method="post" name="adminForm" id="adminForm" class="projectForm" enctype="multipart/form-data">

    <div class="form-horizontal">
        <h1>Project Details</h1>
        <fieldset class="adminform">
            <?php echo $this->form->renderFieldset('details'); ?>
            <button type="button" class="submitButton" onclick="Joomla.submitbutton('project.update')">
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
        <p><b>Deactivate this project</b><br>Your project will no longer be accessible should you choose to deactivate it.</p>
        <button onclick="openModal()">Deactivate this project</button>
    </div>
</div>