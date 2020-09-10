<?php
defined('_JEXEC') or die;

jimport('joomla.application.component.view');

class ProgressToolViewProjectBoard extends JViewLegacy
{
    /**
     * @var object list comprising of data pertaining to the project.
     * @var int position of the project on the project board.
     * @var object list of all inactive projects linked to a user.
     * @var
     */
    protected $project, $projectCount, $projectApprovalSelections, $approvalQuestions;

    function display($tpl = null)
    {
        $input = JFactory::getApplication()->input;
        $projectID = $input->getInt('projectID', 0);

        JLoader::register('Authenticator',  JPATH_BASE . '/components/com_progresstool/helpers/authenticator.php');
        Authenticator::authenticate($projectID);

        $model = parent::getModel('projectboard');
        $this->projectCount = $input->getInt('projectCount', 0);
        $this->project = $model->getProject($projectID);

        if ($this->project->activated == 1)
        {
            parent::display('active');
        }
        else
        {
            $userID = JFactory::getUser()->id;
            $this->projectApprovalSelections = $model->getProjectApprovalSelections($userID);
            $this->approvalQuestions = $model->getApprovalQuestions();
            parent::display('inactive');
        }
    }
}