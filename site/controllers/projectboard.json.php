<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_helloworld
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

class ProgressToolControllerProjectBoard extends JControllerLegacy
{
    /**
     * Processes an approval selection request for an inactive project.
     * Approval selection requests are sent from the ProjectBoard.
     *
     * @since 0.3.0
     */
    public function approvalSelect()
    {
        if (!JSession::checkToken('get'))
        {
            echo new JResponseJson(null, JText::_('JINVALID_TOKEN'), true);
        }
        else
        {
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
                $model->processSelection($projectID, $approvalID);

                if ($model->isProjectApproved($projectID))
                {
                    $model->activateProject($projectID);
                    echo new JResponseJson(true, 'project has been approved.');
                }
                else
                {
                    echo new JResponseJson(false, 'project does not meet the approval criteria yet.');
                }
            }
        }
    }
}