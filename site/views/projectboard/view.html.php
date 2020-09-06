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
     * @var object list containing inactive projects of the current user.
     * @var object list containing approval questions for inactive projects
     */
    protected $projects, $inactiveProjects, $approvalQuestions;

    /**
     * @var
     */
    private $user;

    /**
     * Renders view.
     *
     * @param null $tpl use default template.
     * @since 0.1.2
     */
    function display($tpl = null)
    {
        $this->user = JFactory::getUser();
        $userID = $this->user->id;
        $this->redirectGuest();
        $model = parent::getModel();

        $this->projects = $model->getProjects($userID);
        $this->inactiveProjects = $model->getInactiveProjects($userID);
        $this->approvalQuestions = $model->getApprovalQuestions();

        parent::display($tpl);
        $this->prepareDocument();
    }

    /**
     * If user not logged in, redirect to login.
     *
     * @param object $user the current user object.
     * @since 0.2.6
     */
    private function redirectGuest()
    {
        if ($this->user->get('guest'))
        {
            $return = urlencode(base64_encode('index.php?option=com_progresstool&view=projectboard'));
            JFactory::getApplication()->redirect(
                'index.php?option=com_users&view=login&return=' . $return, 'You must be logged in to use the Progress Tool'
            );
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
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/projectboard.css");
        $document->addScript(JURI::root() . "media/com_progresstool/js/projectboard.js");
    }
}