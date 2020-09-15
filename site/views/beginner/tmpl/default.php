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
<form action="<?php echo JRoute::_('index.php?option=com_progresstool&view=beginner'); ?>"
      method="post" name="adminForm" id="adminForm" class="projectForm" enctype="multipart/form-data">

    <div class="form-horizontal">
        <fieldset class="adminform">
            <legend>Technology Decision Plan</legend>
            <?php // echo $this->form->renderFieldset('details'); ?>
            <div class="test">
                <?php echo $this->form->getLabel('1'); ?>
                <?php echo $this->form->getInput('1'); ?>
            </div>
            <div class="test">
                <?php echo $this->form->getLabel('2'); ?>
                <?php echo $this->form->getInput('2'); ?>
            </div>
            <div class="test">
                <?php echo $this->form->getLabel('3'); ?>
                <?php echo $this->form->getInput('3'); ?>
            </div>
            <div class="test">
                <?php echo $this->form->getLabel('4'); ?>
                <?php echo $this->form->getInput('4'); ?>
            </div>
            <div class="test">
                <?php echo $this->form->getLabel('5'); ?>
                <?php echo $this->form->getInput('5'); ?>
            </div>
            <div class="test">
                <?php echo $this->form->getLabel('6'); ?>
                <?php echo $this->form->getInput('6'); ?>
            </div>
            <div class="test">
                <?php echo $this->form->getLabel('7'); ?>
                <?php echo $this->form->getInput('7'); ?>
            </div>
        </fieldset>
    </div>

    <div class="buttonChest">
        <button type="button" class="buttonCancel" onclick="Joomla.submitbutton('beginner.cancel')">
            <span class="icon-cancel"></span><?php echo ' ' . JText::_('JCANCEL') ?>
        </button>

        <div class="gap"></div>

        <button type="button" class="buttonSubmit" onclick="Joomla.submitbutton('beginner.save')">
            <span class="icon-ok"></span>Continue<?php //echo ' ' . JText::_('JSAVE') ?>
        </button>
    </div>

    <input type="hidden" name="task"/>
    <?php echo JHtml::_('form.token'); ?>
</form>