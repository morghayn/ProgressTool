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
     * @var object
     */
    private $user;

    /**
     * @var int
     * @var array
     * @var array
     * @var array
     */
    protected $projectID, $questions, $choices, $project;

    /**
     * Renders template for the Survey view.
     *
     * @param null $tpl use default template.
     * @since 0.1.0
     */
    function display($tpl = null)
    {
        $input = JFactory::getApplication()->input;
        $model = $this->getModel();

        $this->user = JFactory::getUser();
        $this->redirectGuest();

        $projectIDBas64 = $input->get('projectID', '', 'BASE64');
        $this->projectID = base64_decode($projectIDBas64);
        $this->project = $model->getProject($this->projectID);
        $this->handleAuthentication();

        $countryIndex = $this->getCountryIndex();
        $this->questions = $model->getQuestions($countryIndex);
        $this->choices = $model->getChoices($this->projectID, $countryIndex);

        $this->addStylesheet();
        $this->addScripts();

        // Display the view
        parent::display($tpl);
    }

    /**
     * If user is not logged in, they will be redirected to login screen, and then redirected to their ProjectBoard.
     *
     * @since 0.3.0
     */
    private function redirectGuest()
    {
        if ($this->user->get('guest'))
        {
            $return = urlencode(base64_encode('index.php?option=com_progresstool&view=projectboard'));
            JFactory::getApplication()->redirect('index.php?option=com_users&view=login&return=' . $return);
        }
    }

    /**
     * Authenticates both project and user. First checks to see whether project is exists, then checks if current user should have access to
     * the project. If invalid, user is redirected to their ProjectBoard.
     *
     * @since 0.3.0
     */
    private function handleAuthentication()
    {
        if (!$this->projectID)
        {
            JFactory::getApplication()->redirect('index.php?option=com_progresstool&view=projectboard');
        }
        elseif ($this->project['user_id'] !== $this->user->id)
        {
            JFactory::getApplication()->redirect('index.php?option=com_progresstool&view=projectboard');
        }
    }

    /**
     * Returns country index of the current user. This function is intended to be used in conjunction with JomSocial. If JomSocial is not present,
     * it will instead return 0.
     *
     * @return int the country index for the current user. If JomSocial is not present, it will return '0'.
     * @since 0.3.0
     */
    private function getCountryIndex()
    {
        if (class_exists('CFactory'))
        {
            JFactory::getLanguage()->load('com_community.country', JPATH_SITE, 'en-GB', true);
            $profileCountry = CFactory::getUser()->getInfo('FIELD_COUNTRY');

            $country = JText::_($profileCountry);
            return $this->getModel()->getCountryIndex($country);
        }
        else // for testing purposes
        {
            $country = "Ireland";
            return $this->getModel()->getCountryIndex($country);
            // TODO: return 0 once testing is complete.
        }
    }

    /**
     * // TODO: documentation
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
     * // TODO: documentation
     * @since 0.2.6
     */
    private function addScripts()
    {
        $document = JFactory::getDocument();
        $document->addScript(JURI::root() . "media/com_progresstool/js/survey.js");
    }
}