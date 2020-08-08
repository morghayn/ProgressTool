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
     * Renders view.
     *
     * @param null $tpl use default template.
     * @since 0.1.0
     */
    function display($tpl = null)
    {
        $this->user = JFactory::getUser();
        $this->redirectIfGuest();

        // If user not logged in, redirect to login.
        $projectId = 2;
        $model = $this->getModel();
        $this->dirtyImp = $model->getSelected($projectId);

        $this->questions = array();
        $this->questions = $this->get('Questions');

        $this->choices = array();
        $this->choices = $this->get('Choices');

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
        // Adding CSS and JS
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
        // Adding CSS and JS
        $document = JFactory::getDocument();
        $document->addScript(JURI::root() . "media/com_progresstool/js/survey.js");
    }
}