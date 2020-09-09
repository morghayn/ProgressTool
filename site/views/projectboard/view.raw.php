<?php
defined('_JEXEC') or die;

jimport('joomla.application.component.view');

class ProgressToolViewProjectBoard extends JViewLegacy
{
    /**
     * @var
     * @var
     * @var
     * @var
     */
    protected $project, $projectCount, $inactiveProjects, $approvalQuestions;

    function display($tpl = null)
    {
        $model = parent::getModel('projectboard');
        $user = JFactory::getUser();
        $userID = $user->id;

        $input = JFactory::getApplication()->input;
        $projectID = $input->getInt('projectID', 0);
        $this->projectCount = $input->getInt('projectCount', 0);

        $this->project = $model->getProject($projectID);

        if ($this->project->activated == 1)
        {
            parent::display('active');
        }
        else
        {
            $this->inactiveProjects = $model->getInactiveProjects($userID);
            $this->approvalQuestions = $model->getApprovalQuestions();
            parent::display('inactive');
        }
    }
}