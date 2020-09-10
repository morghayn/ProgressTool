<?php defined('_JEXEC') or die;

/**
 * (Site) Class ProgressToolViewProjectStats
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
    protected $project, $tasks, $categories, $totals;

    /**
     * Renders view.
     *
     * @param null $tpl use default template.
     * @since 0.3.0
     */
    function display($tpl = null)
    {
        $model = parent::getModel();
        $input = JFactory::getApplication()->input;


        $projectID = $input->get('projectID', 1);
        JLoader::register('Authenticator',  JPATH_BASE . '/components/com_progresstool/helpers/authenticator.php');
        Authenticator::authenticate($projectID);
        $this->user = JFactory::getUser();

        $countryID = $this->getCountryID();
        $this->tasks = $model->getTasks($countryID, $projectID);
        $this->categories = $model->getCategories($countryID);
        $this->totals = $model->getTotals($countryID, $projectID);

        parent::display($tpl);
        $this->prepareDocument();
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
     * Prepares document by adding stylesheets and scripts.
     *
     * @since 0.5.0
     */
    private function prepareDocument()
    {
        $document = JFactory::getDocument();
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/masterchest.css");
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/projectstats.css");
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/introductory.css");
        $document->addScript(JURI::root() . "media/com_progresstool/js/projectstats.js");
    }
}