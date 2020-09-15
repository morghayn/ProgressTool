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
        if (!JSession::checkToken('get'))
        {
            echo new JResponseJson(null, JText::_('JINVALID_TOKEN'), true);
        }
        else
        {
            $model = $this->getModel('timelineredirect');
            $input = JFactory::getApplication()->input;

            $categoryID = $input->getInt('categoryID', 0);
            $countryID = $input->getInt('countryID', 0);
            $projectID = $input->getInt('projectID', 0);

            JLoader::register('Authenticator', JPATH_BASE . '/components/com_progresstool/helpers/Authenticator.php');
            Authenticator::authenticate($projectID);

            $categoryGroups = $model->getCategoryGroups($countryID, $projectID);
            $redirects = $model->getRedirects($categoryGroups);

            if ($redirects[$categoryID]['redirect'] != '')
            {
                JFactory::getApplication()->redirect($redirects[$categoryID]['redirect']);
            }
            else
            {
                JFactory::getApplication()->enqueueMessage('You currently are not on the timeline for this section.', 'error');
            }

        }
    }
}