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
        $this->project = parent::getModel()->getProject(5);

        parent::display('activeProject');
    }
}