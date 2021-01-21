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
    protected $heading, $sidebar, $tasks, $categories;

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

        $countryID = $input->getInt('countryID', 0);

        $model = parent::getModel();
        $this->categories = $model->getCategories();
        $this->tasks = $model->getTasks($countryID);

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

        $document->addScript(JURI::root() . "media/com_progresstool/js/admin/adminBase.js");
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/admin/adminBase.css");

        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/admin/tasks.css");
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/js/admin/tasks.js");;
    }
}