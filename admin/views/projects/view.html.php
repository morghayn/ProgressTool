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
     * @var JLayoutFile administrator heading
     * @var JLayoutFile administrator sidebar
     * @var array of project objects
     * @since 0.5.5
     */
    protected $heading, $sidebar, $projects;

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

        $this->setHeading();
        $this->setSidebar();
        $this->prepareDocument();
        parent::display($tpl);
    }

    /**
     * Sets the administrator heading.
     *
     * @since 0.5.5
     */
    private function setHeading()
    {
        $heading = new JLayoutFile(
            'heading',
            JPATH_ADMINISTRATOR . 'components/com_progresstool/layouts'
        );

        $this->heading = $heading->render(
            array(
                "page" => "Projects",
                "additions" => array(
                    '<input class="searchBar" type="text" id="myInput" onkeyup="searchTable()" placeholder="Search by project or username..">'
                )
            )
        );
    }

    /**
     * Sets the administrator sidebar.
     *
     * @since 0.5.5
     */
    private function setSidebar()
    {
        $sidebar = new JLayoutFile(
            'sidebar',
            JPATH_ADMINISTRATOR . 'components/com_progresstool/layouts'
        );

        $this->sidebar = $sidebar->render();
    }

    /**
     * Prepares document by adding stylesheets and scripts.
     *
     * @since 0.5.0
     */
    private function prepareDocument()
    {
        $document = JFactory::getDocument();
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/admin.css");
        $document->addScript(JURI::root() . "media/com_progresstool/js/admin/adminBase.js");
        $document->addScript(JURI::root() . "media/com_progresstool/js/admin/projects.js");
    }
}