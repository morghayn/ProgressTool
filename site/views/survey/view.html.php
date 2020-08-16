<?php defined('_JEXEC') or die;

/**
 * Class ProgressToolViewSurvey
 *
 * View for front-end survey functionality.
 *
 * @package ProgressTool
 * @subpackage site
 * @since 0.1.0
 *
 * @author  Morgan Nolan <morgan.nolan@hotmail.com>
 * @link    https://github.com/morghayn
 * @license GNU General Public License version 2 or later; see LICENSE.txt
 */
class ProgressToolViewSurvey extends JViewLegacy
{
    /**
     * @var array
     * @since 0.2.6
     */
    protected $questions = array();

    /**
     * @var array
     * @since 0.2.6
     */
    protected $choices = array();

    /**
     * @var int
     * @since 0.2.6
     */
    protected $projectID;

    /**
     * Renders view.
     *
     * @param null $tpl use default template.
     * @since 0.1.0
     */
    function display($tpl = null)
    {
        $model = $this->getModel();
        $this->user = JFactory::getUser();

        // If user not logged in, redirect to login.
        $this->redirectIfGuest();

        // Retrieving projectID from URL.
        $this->projectID = base64_decode(JFactory::getApplication()->input->get('projectID', '', 'BASE64'));

        // Redirect if project is not present in URL.
        if(!$this->projectID)
        {
            $this->redirectProjectBoard();
        }

        $this->projectName = $model->getProjectName($this->projectID);

        // TODO: check if current user owns project as part of security protocol

        $countryString = 'France';
        // TODO: for non-official release $countryString = $this->getUserCountryString();
        $countryIndex = $model->getCountryIndex($countryString);

        $this->surveyQuestions = $model->getSurveyQuestions($countryIndex);
        $this->choices = $model->getChoices($this->projectID, $countryIndex);


        $this->questionCounter = 0;
        // Display the view
        parent::display($tpl);
        $this->addStylesheet();
        $this->addScripts();
    }

    /**
     * Code to print a user's country. Will be used to retrieve country specific questions.
     *
     * @param object $cuser the user object
     * @since 0.3.0
     */
    private function getUserCountryString()
    {
        $cuser = CFactory::getUser();
        JFactory::getLanguage()->load('com_community.country', JPATH_SITE, 'en-GB', true);
        $profileCountry = $cuser->getInfo('FIELD_COUNTRY');
        $countryString = JText::_($profileCountry);

        return $countryString;
    }

    /**
     * // TODO: comment
     * If projectID not present...
     *
     * @since 0.2.6
     */
    private function redirectProjectBoard()
    {
        JFactory::getApplication()->redirect('index.php?option=com_progresstool&view=projectboard');
    }

    /**
     * // TODO comment
     * If user not logged in, redirect to login.
     *
     * @since 0.2.6
     */
    private function redirectIfGuest()
    {
        if ($this->user->get('guest'))
        {
            $return = urlencode(base64_encode('index.php?option=com_progresstool&view=survey'));
            JFactory::getApplication()->redirect('index.php?option=com_users&view=login&return=' . $return);
            //JFactory::getApplication()->redirect(JRoute::_('index.php?option=com_users&view=login', JText::_("You must be logged in to view this content")));
        }
    }

    /**
     * // TODO comment
     * @since 0.2.6
     */
    private function addStylesheet()
    {
        $document = JFactory::getDocument();
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/masterChest.css");
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/optionsChest.css");
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/survey.css");
    }

    /**
     * // TODO comment
     * @since 0.2.6
     */
    private function addScripts()
    {
        $document = JFactory::getDocument();
        $document->addScript(JURI::root() . "media/com_progresstool/js/survey.js");
    }
}