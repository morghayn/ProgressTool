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
     * @var
     * @since 0.2.1
     */
    protected $redirect;

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

        // TODO: Fetch User Projects
        $model = parent::getModel();
        $this->projects = array();
        $this->projects = $model->getUserProjects($this->user->id);

        // TODO: Generate Project Graph

        $this->approvalQuestions = $this->get('ApprovalQuestions');
        $this->approvalSelections = $model->getApprovalSelections($this->user->id);
        //var_dump($this->approvalSelections);

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
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/projectboard.css");
        //JHTML::stylesheet('media/jui/css/bootstrap.min.css');
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