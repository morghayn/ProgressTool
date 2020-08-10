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
     * Renders view.
     *
     * @param null $tpl use default template.
     * @since 0.1.0
     */
    function display($tpl = null)
    {
        $model = $this->getModel();
        $this->user = JFactory::getUser();

        // Todo: hard-coded... must implement fetching project id from redirect
        $data = array();
        $input = JFactory::getApplication()->input;
        // todo project is in the url and not projectid... a bit annoying and inconsistent.
        $data['projectID'] = base64_decode($input->get('project', '', 'BASE64'));


        $this->projectID = $data['projectID'];
        $this->projectName = $model->getProjectName($this->projectID );

        // TODO check if current user owns project as part of security protocol

        // If user not logged in, redirect to login.
        $this->redirectIfGuest();

        $this->questions = $this->get('Questions');
        $this->choices = $this->get('Choices');
        $this->dirtyImp = $model->getSelected($this->projectID);

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