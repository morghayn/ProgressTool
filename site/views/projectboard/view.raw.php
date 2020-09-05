<?php
defined('_JEXEC') or die;

jimport('joomla.application.component.view');

class ProgressToolViewProjectBoard extends JViewLegacy
{
    /**
     * @var
     * @var
     */
    protected $project, $projectCount;

    function display($tpl = null)
    {
        //$user = JFactory::getUser();
        $model = parent::getModel('projectboard');
        $input = JFactory::getApplication()->input;

        $projectID = $input->getInt('projectID', 0);
        $this->projectCount = $input->getInt('projectCount', 0);
        $this->project = $model->getProject($projectID);

        parent::display('active');
    }
}