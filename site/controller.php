<?php defined('_JEXEC') or die;

/**
 * Class ProgressToolController
 *
 * Main component controller for the component's front-end.
 *
 * @package ProgressTool
 * @subpackage site
 * @since 0.0.1
 *
 * @author  Morgan Nolan <morgan.nolan@hotmail.com>
 * @link    https://github.com/morghayn
 */
class ProgressToolController extends JControllerLegacy
{
    /**
     * Creates a new project.
     * Project creation requests are sent from the ProjectCreate form.
     *
     * @since 0.2.6
     */
    public function createProject()
    {
        if (!JSession::checkToken('get'))
        {
            echo new JResponseJson(null, JText::_('JINVALID_TOKEN'), true);
        }
        else
        {
            $user = JFactory::getUser();
            $model = parent::getModel('projectcreate');
            $input = JFactory::getApplication()->input;

            $projectData = $input->get('projectData', array(), 'ARRAY');
            $name = $projectData['name'];
            $description = $projectData['description'];
            $type = $projectData['type'];
            $model->insertProject($user->id, $name, $description, $type);

            // TODO: should I redirect here instead of client side?
            echo new JResponseJson(true, 'success');
        }
    }

    /**
     * Processes a survey choice selection request.
     * Choice selections are sent from the Survey.
     *
     * @since 0.3.0
     */
    public function surveySelect()
    {
        if (!JSession::checkToken('get'))
        {
            echo new JResponseJson(null, JText::_('JINVALID_TOKEN'), true);
        }
        else
        {
            parent::display();
        }
    }

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

    /**
     * Generates HTML for a newly activated project so that it can be updated without a redirect.
     *
     * @since 0.3.0
     */
    public function activeProjectTemplate()
    {
        if (!JSession::checkToken('get'))
        {
            echo new JResponseJson(null, JText::_('JINVALID_TOKEN'), true);
        }
        else
        {
            // TODO remove after looking into this code for templating $this->input->set('active', 'ProjectBoard');
            parent::display();
        }
    }
}
