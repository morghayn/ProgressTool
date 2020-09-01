<?php defined('_JEXEC') or die;

/**
 * Class ProgressToolViewProjectStats
 *
 * View for front-end project stats functionality.
 *
 * @package ProgressTool
 * @subpackage site
 * @since 0.3.0
 *
 * @author  Morgan Nolan <morgan.nolan@hotmail.com>
 * @link    https://github.com/morghayn
 */
class ProgressToolViewProjectStats extends JViewLegacy
{
    /**
     * @var
     */
    private $user;

    /**
     * @var
     * @var
     * @var
     * @var
     */
    protected $projectID, $project, $tasks, $categories;

    /**
     * Renders view.
     *
     * @param null $tpl use default template.
     * @since 0.3.0
     */
    function display($tpl = null)
    {
        $input = JFactory::getApplication()->input;
        $model = parent::getModel();

        $this->user = JFactory::getUser();
        $this->redirectGuest();

        $this->projectID = $input->get('projectID', 1);
        $this->project = $model->getProject($this->projectID);
        $this->handleAuthentication();

        $countryID = $this->getCountryID();
        $this->tasks = $model->getTasks($countryID, $this->projectID);
        $this->categories = $model->getCategories($countryID);
        $this->totals = $model->getTotals($countryID, $this->projectID);

        $this->addStylesheet();
        $this->addScripts();
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
            JFactory::getApplication()->redirect(
                'index.php?option=com_users&view=login&return=' . $return,
                'You must be logged in to use the Progress Tool'
            );
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
            JFactory::getApplication()->redirect(
                JRoute::_('index.php?option=com_progresstool&view=projectboard', 'You must be logged in to use the Progress Tool.'),
                'You must be logged in to use the Progress Tool'
            );
        }
        elseif ($this->project['user_id'] !== $this->user->id)
        {
            JFactory::getApplication()->redirect(
                JRoute::_('index.php?option=com_progresstool&view=projectboard', 'You must be logged in to use the Progress Tool.'),
                'You must be logged in to use the Progress Tool'
            );
        }
    }

    /**
     * Returns country index of the current user. This function is intended to be used in conjunction with JomSocial. If JomSocial is not present,
     * it will instead return 0.
     *
     * @return int the country index for the current user. If JomSocial is not present, it will return '0'.
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
     * // TODO: documentation
     * @since 0.3.0
     */
    private function addStylesheet()
    {
        $document = JFactory::getDocument();
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/masterChest.css");
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/projectstats.css");
    }

    /**
     * // TODO: documentation
     * @since 0.3.0
     */
    private function addScripts()
    {
        $document = JFactory::getDocument();
        // TODO: remove $document->addScript(JURI::root() . "media/com_progresstool/js/chart.js");
        $document->addScript(JURI::root() . "media/com_progresstool/js/projectstats.js");
    }
}