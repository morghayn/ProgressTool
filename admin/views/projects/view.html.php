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
     * @var JLayoutFile administrator sidebar
     * @var array of project objects.
     * @since 0.5.5
     */
    protected $sidebar, $projects;

    /**
     * Renders view.
     *
     * @param string $tpl
     * @since 0.5.0
     */
    function display($tpl = null)
    {
        $model = parent::getModel();
        $this->projects = $model->getProjects();

        $this->setSidebar();
        $this->prepareDocument();
        parent::display($tpl);
    }

    /**
     * Loads the administrator sidebar.
     *
     * @since 0.5.5
     */
    private function setSidebar()
    {
        $this->sidebar = new JLayoutFile(
            'sidebar',
            JPATH_ADMINISTRATOR . 'components/com_progresstool/layouts'
        );
    }

    /**
     * Prepares document by adding stylesheets and scripts.
     *
     * @since 0.5.0
     */
    private function prepareDocument()
    {
        $document = JFactory::getDocument();

        $document->addScript(JURI::root() . "media/com_progresstool/js/admin/adminBase.js");
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/admin/adminBase.css");

        $document->addScript(JURI::root() . "media/com_progresstool/js/admin/projects.js");
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/admin/projects.css");
    }
}