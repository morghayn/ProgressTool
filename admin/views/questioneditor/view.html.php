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
     * @param string $tpl
     * @since 0.5.0
     */
    function display($tpl = null)
    {
        try
        {
            $app = JFactory::getApplication();
            $input = $app->input;

            $model = parent::getModel();
            $questionID = $input->getInt('questionID', 0);

            $this->question = $model->getQuestion($questionID);
            $this->choices = $model->getChoices($questionID);

            $this->prepareDocument();
            parent::display($tpl);
        }
        catch (Exception $e)
        {
            echo 'Something appears to have gone wrong.';
        }
    }

    /**
     * Prepares document by adding stylesheets and scripts.
     *
     * @since 0.5.0
     */
    private function prepareDocument()
    {
        $document = JFactory::getDocument();
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/site/masterchest.css");
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/site/optionschest.css");
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/site/survey.css");
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/admin/questionEditor.css");

        $document->addScript(JURI::root() . "media/com_progresstool/js/admin/questionEditor.js");
    }
}