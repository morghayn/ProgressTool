<?php defined('_JEXEC') or die;

/**
 * (Admin) Class ProgressToolViewTasks
 *
 * View for back-end tasks functionality.
 *
 * @package ProgressTool
 * @subpackage admin
 * @since 0.5.0
 *
 * @author  Morgan Nolan <morgan.nolan@hotmail.com>
 * @link    https://github.com/morghayn
 */
class ProgressToolViewTasks extends JViewLegacy
{
    /**
     * @var JLayoutFile administrator heading
     * @var JLayoutFile administrator sidebar
     * @object comprising of tasks of objects
     * @since 0.5.5
     */
    protected $heading, $sidebar, $tasks, $categories, $choices, $countryID;

    /**
     * Renders view.
     *
     * @param string $tpl
     * @since 0.5.0
     */
    function display($tpl = null)
    {
        $app = JFactory::getApplication();
        $input = $app->input;

        $this->countryID = $input->getInt('countryID', 0);

        $model = parent::getModel();
        $this->categories = $model->getCategories();
        $this->tasks = $model->getTasks($this->countryID);
        $this->choices = $model->getChoices($this->countryID);

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
                "page" => "Tasks",
                "additions" => array(
                    '<button onclick="openAllTaskEditors()">Open all tasks</button>',
                    '<button onclick="closeAllTaskEditors()">Close all tasks</button>'
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
        $document->addScript(JURI::root() . "media/com_progresstool/js/admin/tasks.js");
    }
}