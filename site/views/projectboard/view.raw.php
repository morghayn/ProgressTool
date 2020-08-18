<?php
defined('_JEXEC') or die;

jimport('joomla.application.component.view');

class ProgressToolViewProjectBoard extends JViewLegacy
{
    /** // TODO: Documentation here
     * @var
     */
    protected $project;

    function display($tpl = null)
    {
        $input = JFactory::getApplication()->input;
        $data = $input->get('data', array(), 'ARRAY');
        $projectID = $data['projectID'];

        if (!$projectID)
        {
            echo "<h1>An error occurred, please reload your page</h1>";
        }
        else
        {
            $this->project = parent::getModel()->getProject($projectID);
            parent::display('active');
        }
    }
}