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
class ProgressToolViewPool extends JViewLegacy
{
    /**
     * @var array of question objects.
     * @var array of choice objects.
     * @since 0.5.0
     */
    protected $questions, $choices;

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
            $poolID = $input->getInt('pool', 0);

            $this->questions = $model->getQuestions($poolID);
            $this->choices = $model->getChoices($poolID);

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
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/admin/pool.css");
    }
}