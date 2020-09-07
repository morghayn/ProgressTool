<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_helloworld
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 *
 * This layout file is for displaying the front end form for capturing a new helloworld message
 *
 */

// No direct access
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.formvalidator');

?>
<form action="<?php echo JRoute::_('index.php?option=com_progresstool&view=settings'); ?>"
      method="post" name="adminForm" id="adminForm" class="projectForm" enctype="multipart/form-data">

    <div class="form-horizontal">
        <fieldset class="adminform">
            <legend>Project Creation Form</legend>
            <?php // echo $this->form->renderFieldset('details'); ?>
            <div class="test">
                <?php echo $this->form->getInput('projectID'); ?>
            </div>
            <div class="test">
                <?php echo $this->form->getLabel('name'); ?>
                <?php echo $this->form->getInput('name'); ?>
            </div>
            <div class="test">
                <?php echo $this->form->getLabel('description'); ?>
                <?php echo $this->form->getInput('description'); ?>
            </div>
            <div class="test">
                <?php echo $this->form->getLabel('type'); ?>
                <?php echo $this->form->getInput('type'); ?>
            </div>
            <div class="test">
                <?php echo $this->form->getLabel('group'); ?>
                <?php echo $this->form->getInput('group'); ?>
            </div>
        </fieldset>
    </div>

    <div class="buttonChest">
        <button type="button" class="buttonCancel" onclick="Joomla.submitbutton('settings.cancel')">
            <span class="icon-cancel"></span><?php echo ' ' . JText::_('JCANCEL') ?>
        </button>

        <button type="button" class="buttonSubmit" onclick="Joomla.submitbutton('settings.update')">
            <span class="icon-ok"></span><?php echo ' ' . JText::_('JSAVE') ?>
        </button>
    </div>

    <input type="hidden" name="task"/>
    <?php echo JHtml::_('form.token'); ?>
</form>