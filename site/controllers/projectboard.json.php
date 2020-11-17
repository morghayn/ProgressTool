<?php

/**
 * (Site) Class ProgressToolControllerProjectBoard
 *
 * Controller for back-end projectboard functionality.
 *
 * @package ProgressTool
 * @subpackage admin
 * @since 0.5.0
 *
 * @author  Morgan Nolan <morgan.nolan@hotmail.com>
 * @link    https://github.com/morghayn
 */
class ProgressToolControllerProjectBoard extends JControllerLegacy
{
    /**
     * Returns JSON response for an approval selection.
     *
     * @since 0.3.0
     */
    public function approvalSelect()
    {
        JSession::checkToken('get') or jexit(JText::_('JINVALID_TOKEN'));

        $user = JFactory::getUser();
        $model = parent::getModel('projectboard');
        $input = JFactory::getApplication()->input;

        $projectID = $input->getInt('projectID', 0);
        $approvalID = $input->getInt('approvalID', 0);

        $project = $model->getProject($projectID);

        // If project does not exist.
        if (is_null($project))
        {
            echo new JResponseJson(false, 'project does not exist.');
        }

        // If user does not have access to the project.
        elseif ($project->user_id !== $user->id)
        {
            echo new JResponseJson(false, 'project authentication failed.');
        }

        // If project is already approved.
        elseif ($project->activated != 0)
        {
            echo new JResponseJson(false, 'project is already approved.');
        }

        // All good, process selection.
        else
        {
            $status = $model->processSelection($projectID, $approvalID);
            echo new JResponseJson($status, ($status ? 'project has been approved.' : 'project does not meet the approval criteria yet.'));
        }
    }
}