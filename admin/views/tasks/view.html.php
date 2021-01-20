<?php defined('_JEXEC') or die;

/**
 * (Admin) Class ProgressToolViewPool
 *
 * View for back-end pool functionality.
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
     * @var JLayoutFile administrator sidebar
     * @since 0.5.5
     */
    protected $sidebar;

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

        $model = parent::getModel();
        $countryID = $input->getInt('countryID', 0);

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

        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/admin/tasks.css");
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/js/admin/tasks.js");;
    }
}