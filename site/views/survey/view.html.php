<?php defined('_JEXEC') or die;

/**
 * (Site) Class ProgressToolViewSurvey
 *
 * View for front-end survey functionality.
 *
 * @package ProgressTool
 * @subpackage site
 * @since 0.1.0
 *
 * @author  Morgan Nolan <morgan.nolan@hotmail.com>
 * @link    https://github.com/morghayn
 */
class ProgressToolViewSurvey extends JViewLegacy
{
    /**
     * @var int
     * @var array
     * @var array
     * @var array
     */
    protected $projectID, $questions, $choices, $project, $timelineRedirects;

    /**
     * Renders template for the Survey view.
     *
     * @param null $tpl use default template.
     * @since 0.1.0
     */
    function display($tpl = null)
    {
        $model = parent::getModel();
        $input = JFactory::getApplication()->input;
        $this->projectID = $input->getInt('projectID', 0);

        JLoader::register('Authenticator',  JPATH_BASE . '/components/com_progresstool/helpers/Authenticator.php');
        Authenticator::authenticate($this->projectID);

        JLoader::register('getCountry',  JPATH_BASE . '/components/com_progresstool/helpers/getCountry.php');
        $countryID = getCountry::getCountryID();

        JLoader::register('GetTimelineRedirects',  JPATH_BASE . '/components/com_progresstool/helpers/GetTimelineRedirects.php');
        $this->timelineRedirects = GetTimelineRedirects::timelineRedirects($countryID, $this->projectID);

        $this->questions = $model->getQuestions($countryID);
        $this->choices = $model->getChoices($this->projectID, $countryID);

        parent::display($tpl);
        $this->prepareDocument();
    }

    /**
     * Prepares document by adding stylesheets and scripts.
     *
     * @since 0.2.6
     */
    private function prepareDocument()
    {
        $document = JFactory::getDocument();
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/masterchest.css");
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/optionschest.css");
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/survey.css");
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/introductory.css");
        $document->addScript(JURI::root() . "media/com_progresstool/js/survey.js");
    }
}