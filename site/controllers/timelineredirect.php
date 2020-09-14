<?php defined('_JEXEC') or die;

/**
 * (Site) Class ProgressToolControllerTimelineRedirect
 *
 * Redirects a user to their position within the timeline
 *
 * @package ProgressTool
 * @subpackage site
 * @since 0.1.7
 *
 * @author  Morgan Nolan <morgan.nolan@hotmail.com>
 * @link    https://github.com/morghayn
 */
class ProgressToolControllerTimelineRedirect extends JControllerLegacy
{
    /**
     * Returns JSON response for a survey selection.
     *
     * @since 0.1.7
     */
    public function redirect()
    {
        if (!JSession::checkToken('get'))
        {
            echo new JResponseJson(null, JText::_('JINVALID_TOKEN'), true);
        }
        else
        {
            JFactory::getApplication()->redirect(
                JRoute::_('index.php?option=com_progresstool&view=projectboard', $genericErrorMessage), $genericErrorMessage
            );
        }
    }
}