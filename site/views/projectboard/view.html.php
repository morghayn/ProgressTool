<?php defined('_JEXEC') or die;

/**
 * (Site) Class ProgressToolViewProjectBoard
 *
 * View for front-end project board functionality.
 *
 * @package ProgressTool
 * @subpackage site
 * @since 0.1.2
 *
 * @author  Morgan Nolan <morgan.nolan@hotmail.com>
 * @link    https://github.com/morghayn
 */
class ProgressToolViewProjectBoard extends JViewLegacy
{
    /**
     * @var object list containing projects of the current user.
     * @var array containing all approval selections made by the inactive projects associated with a user.
     * @var object list containing approval questions for inactive projects
     * @since 0.2.6
     */
    protected $projects, $projectApprovalSelections, $approvalQuestions;

    /**
     * Renders the project board view.
     *
     * @param null $tpl use default template.
     * @since 0.1.2
     */
    function display($tpl = null)
    {
        JLoader::register('Auth',  JPATH_BASE . '/components/com_progresstool/helpers/Auth.php');
        Auth::redirectGuests();

        $model = parent::getModel();
        $userID = JFactory::getUser()->id;

        $this->projects = $model->getProjects($userID);
        $this->projectApprovalSelections = $model->getProjectApprovalSelections($userID);
        $this->approvalQuestions = $model->getApprovalQuestions();

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
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/site/masterchest.css");
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/site/optionschest.css");
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/site/projectboard.css");
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/site/introductory.css");
        $document->addScript(JURI::root() . "media/com_progresstool/js/site/projectboard.js");
    }
}