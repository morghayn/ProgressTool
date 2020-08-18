<?php defined('_JEXEC') or die;

/**
 * Class ProgressToolViewAdministrator
 *
 * View for back-end administrator functionality.
 *
 * @package ProgressTool
 * @subpackage admin
 * @since 0.1.2
 *
 * @author  Morgan Nolan <morgan.nolan@hotmail.com>
 * @link    https://github.com/morghayn
 */
class ProgressToolViewAdministrator extends JViewLegacy
{
    /**
     * TODO: documentation
     *
     * @param string $tpl The name of the template file to parse; automatically searches through the template paths.
     *
     * @return void
     * @since 0.3.0
     */
    function display($tpl = null)
    {
        // Adding CSS and JS
        $document = JFactory::getDocument();
        $document->addScript(JURI::root() . "media/com_progresstool/js/survey.js");
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/admin.css");
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/masterChest.css");
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/optionsChest.css");

        // Display the view
        parent::display($tpl);
    }
}