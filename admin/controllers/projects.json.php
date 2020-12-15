<?php defined('_JEXEC') or die;

/**
 * (Admin) Class ProgressToolControllerProjects
 *
 * Controller for back-end projects functionality.
 *
 * @package ProgressTool
 * @subpackage admin
 * @since 0.5.0
 *
 * @author  Morgan Nolan <morgan.nolan@hotmail.com>
 * @link    https://github.com/morghayn
 */
class ProgressToolControllerProjects extends JControllerLegacy
{
    public function delete()
    {
        JSession::checkToken('post') or jexit(JText::_('JINVALID_TOKEN'));

        $model = $this->getModel('projects');
        $input = JFactory::getApplication()->input;

        $projectID = $input->getInt('projectID', 0);

        //echo $projectID;
    }
}