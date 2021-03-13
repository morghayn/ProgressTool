<?php defined('_JEXEC') or die;

/**
 * (Admin) Class ProgressToolViewTests
 *
 * View for back-end tests.
 *
 * @package ProgressTool
 * @subpackage admin
 * @since 0.5.0
 *
 * @author  Morgan Nolan <morgan.nolan@hotmail.com>
 * @link    https://github.com/morghayn
 */
class ProgressToolViewTest extends JViewLegacy
{
    public $heading, $sidebar;

    /**
     * Renders view.
     *
     * @param string $tpl
     * @since 0.5.0
     */
    function display($tpl = null)
    {
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
                "page" => "Test",
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
    }
}