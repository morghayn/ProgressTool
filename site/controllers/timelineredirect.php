<?php defined('_JEXEC') or die;

/**
 * (Site) Class ProgressToolControllerTimelineRedirect
 *
 * Handles routing for timeline redirection
 *
 * @package ProgressTool
 * @subpackage admin
 * @since 0.5.0
 *
 * @author  Morgan Nolan <morgan.nolan@hotmail.com>
 * @link    https://github.com/morghayn
 */
class ProgressToolControllerTimelineRedirect extends JControllerLegacy
{
    public function redirect($key = null, $urlVar = null)
    {
        JSession::checkToken('get') or jexit(JText::_('JINVALID_TOKEN'));
        $input = JFactory::getApplication()->input;

        $countryID = $input->getInt('countryID', 0);
        $categoryID = $input->getInt('categoryID', 0);
        $projectID = $input->getInt('projectID', 0);

        // Authorization
        JLoader::register('Auth', JPATH_BASE . '/components/com_progresstool/helpers/Auth.php');
        Auth::authorize($projectID);

        $model = $this->getModel('timelineredirect');
        $progress = $model->getProgress($countryID, $categoryID, $projectID);
        $redirect = $model->getRedirects($categoryID, $progress);

        JFactory::getApplication()->redirect($redirect);
    }
}