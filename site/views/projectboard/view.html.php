<?php defined('_JEXEC') or die;

/**
 * Class ProgressToolViewProjectBoard
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
     * Renders view.
     *
     * @param null $tpl use default template.
     * @since 0.1.2
     */
    function display($tpl = null)
    {
        $this->user = JFactory::getUser();

        // If user not logged in, redirect to login.
        $this->redirectIfGuest();

        $model = parent::getModel();
        $this->projects = array();
        $this->projects = $model->getProjects($this->user->id);

        $this->approvalQuestions = $this->get('ApprovalQuestions');
        $this->approvalSelects = $model->getApprovalSelects($this->user->id);

        $this->addStylesheet();
        $this->addScripts();

        // Display the view
        parent::display($tpl);
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
            $return = urlencode(base64_encode('index.php?option=com_progresstool&view=projectboard'));
            JFactory::getApplication()->redirect(
                'index.php?option=com_users&view=login&return=' . $return,
                'You must be logged in to use the Progress Tool'
            );
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
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/projectboard.css");
    }

    /**
     * // TODO comment
     * @since 0.2.6
     */
    private function addScripts()
    {
        $document = JFactory::getDocument();
        $document->addScript(JURI::root() . "media/com_progresstool/js/projectboard.js");
    }
}