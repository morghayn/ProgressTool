<?php

/**
 * (Site) Class ProgressToolControllerTest
 *
 * Controller for back-end advanced functionality.
 *
 * @package ProgressTool
 * @subpackage admin
 * @since 0.5.0
 *
 * @author  Morgan Nolan <morgan.nolan@hotmail.com>
 * @link    https://github.com/morghayn
 */
class ProgressToolControllerTest extends JControllerLegacy
{
    public function myTest()
    {
        //JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

        $app = JFactory::getApplication();
        $app->enqueueMessage("HelloWorld");
        $this->setRedirect('index.php?option=com_progresstool&view=pools');
    }
}