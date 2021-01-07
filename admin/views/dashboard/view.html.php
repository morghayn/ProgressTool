<?php defined('_JEXEC') or die;

/**
 * (Admin) Class ProgressToolViewDashboard
 *
 * View for back-end dashboard functionality.
 *
 * @package ProgressTool
 * @subpackage admin
 * @since 0.3.0
 *
 * @author  Morgan Nolan <morgan.nolan@hotmail.com>
 * @link    https://github.com/morghayn
 */
class ProgressToolViewDashboard extends JViewLegacy
{
    /**
     * Renders view.
     *
     * @param string $tpl
     * @since 0.3.0
     */
    function display($tpl = null)
    {
        $this->prepareDocument();
        parent::display();
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
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/admin/dashboard.css");
    }
}