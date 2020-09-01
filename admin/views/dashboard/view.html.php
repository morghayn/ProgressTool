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
    protected $form = null;

    /**
     * Renders view.
     *
     * @param string $tpl The name of the template file to parse; automatically searches through the template paths.
     * @since 0.3.0
     */
    function display($tpl = null)
    {
        // Get the form to display
        $this->form = $this->get('Form');
        // Get the javascript script file for client-side validation
        $this->script = $this->get('Script');

        $model = parent::getModel();

        $countryID = 1;
        $this->questions = $model->getQuestions($countryID);
        $this->choices = $model->getChoices($countryID);

        $this->addStylesheet();
        $this->addScripts();

        // Display the view
        parent::display($tpl);
    }

    /**
     * Adds stylesheets.
     *
     * @since 0.2.6
     */
    private function addStylesheet()
    {
        $document = JFactory::getDocument();
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/masterChest.css");
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/optionsChest.css");
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/survey.css");
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/admin/dashboard.css");

        $document->addScript(JURI::root() . $this->script);
        $document->addScript(JURI::root() . "media/com_progresstool/forms/submitbutton.js");
        $document->addScript(JURI::root() . "media/com_progresstool/js/imagetoggle.js");
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/projectcreate.css");
    }

    /**
     * Adds JavaScript.
     *
     * @since 0.2.6
     */
    private function addScripts()
    {
        $document = JFactory::getDocument();
        $document->addScript(JURI::root() . "media/com_progresstool/js/survey.js");
    }
}