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
     * @var object list comprising of the questions associated with the pool.
     * @var object list comprising of the choices grouped by the question identifiers for the questions associated with the pool.
     */
    protected $questions, $choices;

    /**
     * Renders view.
     *
     * @param string $tpl The name of the template file to parse; automatically searches through the template paths.
     * @since 0.5.0
     */
    function display($tpl = null)
    {
        $model = parent::getModel();
        $input = JFactory::getApplication()->input;

        $poolID = $input->getInt('pool', 0); // TODO: verify poolID exists first...

        $this->questions = $model->getQuestions($poolID);
        $this->choices = $model->getChoices($poolID);

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
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/admin/pool.css");
    }
}