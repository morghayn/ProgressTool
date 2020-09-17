<?php defined('_JEXEC') or die;

/**
 * Class ProgressToolViewQuestionEditor
 *
 * View for back-end question editor functionality.
 *
 * @package ProgressTool
 * @subpackage admin
 * @since 0.5.0
 *
 * @author  Morgan Nolan <morgan.nolan@hotmail.com>
 * @link    https://github.com/morghayn
 */
class ProgressToolViewQuestionEditor extends JViewLegacy
{
    protected $question, $choices;

    /**
     * Renders view.
     *
     * @param string $tpl The name of the template file to parse; automatically searches through the template paths.
     * @since 0.5.0
     */
    function display($tpl = null)
    {
        $model = parent::getModel();

        $questionID = 1;
        $this->question = $model->getQuestion($questionID);
        $this->choices = $model->getChoices($questionID);

        // Display the view
        parent::display($tpl);
        $this->prepareDocument();
    }

    /**
     * Prepares document by adding stylesheets and scripts.
     *
     * @since 0.5.0
     */
    private function prepareDocument()
    {
        $document = JFactory::getDocument();
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/masterchest.css");
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/optionschest.css");
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/survey.css");
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/admin/questionEditor.css");

        $document->addScript(JURI::root() . "media/com_progresstool/js/admin/questionEditor.js");
    }
}