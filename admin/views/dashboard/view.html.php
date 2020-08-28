<?php defined('_JEXEC') or die;

/**
 * Class ProgressToolViewDashboard
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
     * @param string $tpl The name of the template file to parse; automatically searches through the template paths.
     * @since 0.3.0
     */
    function display($tpl = null)
    {
        // Adding CSS and JS
        $document = JFactory::getDocument();
        $document->addScript(JURI::root() . "media/com_progresstool/js/survey.js");
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/admin/admin.css");

        // Display the view
        parent::display($tpl);
    }
}