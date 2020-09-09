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
    protected $projectID, $questions, $choices, $project;

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
        $this->projectID = $input->get('projectID', 1);
        $this->project = $model->getProject($this->projectID);
        $this->handleAuthentication();

        $countryID = $this->getCountryID();
        $this->questions = $model->getQuestions($countryID);
        $this->choices = $model->getChoices($this->projectID, $countryID);

        // Display the view
        parent::display($tpl);
        $this->prepareDocument();
    }

    /**
     * Authenticates both user and project. If invalid, user is redirected.
     *
     * @since 0.3.0
     */
    private function handleAuthentication()
    {
        $user = JFactory::getUser();

        // If user is guest.
        if ($user->get('guest'))
        {
        $return = urlencode(base64_encode('index.php?option=com_progresstool&view=projectboard'));
            JFactory::getApplication()->redirect(
                'index.php?option=com_users&view=login&return=' . $return,
                'You must be logged in to use the Progress Tool'
            );
        }


        // If project does not exist.
        elseif (!$this->project)
        {
            JFactory::getApplication()->redirect(
                JRoute::_('index.php?option=com_progresstool&view=projectboard', 'You must be logged in to use the Progress Tool.'),
                'You must be logged in to use the Progress Tool'
            );
        }

        // If user should not have access to the project.
        elseif ($this->project['user_id'] !== $user->id)
        {
            JFactory::getApplication()->redirect(
                JRoute::_('index.php?option=com_progresstool&view=projectboard', 'You must be logged in to use the Progress Tool.'),
                'You must be logged in to use the Progress Tool'
            );
        }
    }

    /**
     * Returns countryID of the current user. This function is intended to be used in conjunction with JomSocial. If JomSocial is not present,
     * it will instead return 0.
     *
     * @return int the countryID for the current user. If JomSocial is not present, it will return '0'.
     * @since 0.3.0
     */
    private function getCountryID()
    {
        if (class_exists('CFactory'))
        {
            JFactory::getLanguage()->load('com_community.country', JPATH_SITE, 'en-GB', true);
            $profileCountry = CFactory::getUser()->getInfo('FIELD_COUNTRY');

            $country = JText::_($profileCountry);
            return parent::getModel()->getCountryID($country);
        }
        else // for testing purposes
        {
            $country = "Ireland";
            return parent::getModel()->getCountryID($country);
            // TODO: return 0 once testing is complete.
        }
    }

    /**
     * Prepares document by adding stylesheets and scripts.
     *
     * @since 0.2.6
     */
    private function prepareDocument()
    {
        $document = JFactory::getDocument();
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/masterChest.css");
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/optionsChest.css");
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/survey.css");
        $document->addScript(JURI::root() . "media/com_progresstool/js/survey.js");
    }
}