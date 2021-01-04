<?php defined('_JEXEC') or die;

/**
 * (Admin) Class ProgressToolViewProjects
 *
 * View for back-end projects functionality.
 *
 * @package ProgressTool
 * @subpackage admin
 * @since 0.5.0
 *
 * @author  Morgan Nolan <morgan.nolan@hotmail.com>
 * @link    https://github.com/morghayn
 */
class ProgressToolViewProjects extends JViewLegacy
{
    /**
     * @var object list of all projects on record.
     * @since 0.5.0
     */
    protected $projects;

    /**
     * Renders view.
     *
     * @param string $tpl The name of the template file to parse; automatically searches through the template paths.
     * @since 0.5.0
     */
    function display($tpl = null)
    {
        $model = parent::getModel();
        $this->projects = $model->getProjects();

        parent::display($tpl);
        $this->prepareDocument();
    }

    /**
     * Prepares document by adding stylesheets and scripts.
     *
     * @since 0.5.0
     */
    private function prepareDocument()
    {
        $document = JFactory::getDocument();
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/admin/joomlaOverride.css");
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/admin/projects.css");
        $document->addScript(JURI::root() . "media/com_progresstool/js/admin/projects.js");

    }
}