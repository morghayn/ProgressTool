<?php defined('_JEXEC') or die;

/**
 * (Admin) Class ProgressToolViewQuestions
 *
 * View for back-end questions functionality.
 *
 * @package ProgressTool
 * @subpackage admin
 * @since 0.5.0
 *
 * @author  Morgan Nolan <morgan.nolan@hotmail.com>
 * @link    https://github.com/morghayn
 */
class ProgressToolViewQuestions extends JViewLegacy
{
    /**
     * @var JLayoutFile administrator heading
     * @var JLayoutFile administrator sidebar
     * @var array of question objects
     * @var array of choice objects
     * @since 0.5.5
     */
    protected $heading, $questions, $choices;

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

        $this->questions = $model->getQuestions($countryID);
        $this->choices = $model->getChoices($countryID);

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
                "page" => "Questions",
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

        $document->addScript(JURI::root() . "media/com_progresstool/js/admin/adminBase.js");
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/admin/adminBase.css");

        $document->addScript(JURI::root() . "media/com_progresstool/js/admin/questions.js");
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/admin/questions.css");

        // TODO: put in one file
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/site/masterchest.css");
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/site/optionschest.css");
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/site/survey.css");
    }
}