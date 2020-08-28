<?php defined('_JEXEC') or die;

/**
 * Class ProgressToolViewProjectCreate
 *
 * View for front-end project creation functionality.
 *
 * @package ProgressTool
 * @subpackage site
 * @since 0.2.6
 *
 * @author  Morgan Nolan <morgan.nolan@hotmail.com>
 * @link    https://github.com/morghayn
 */
class ProgressToolViewProjectCreate extends JViewLegacy
{
    /**
     * // TODO: document this
     * @var
     */
    protected $projectTypes;

    /**
     * Renders view.
     *
     * @param null $tpl use default template.
     * @since 0.2.6
     */
	function display($tpl = null)
	{
        $this->user = JFactory::getUser();

        // If user not logged in, redirect to login.
        $this->redirectIfGuest();

        $this->projectTypes = parent::getModel()->getProjectTypes();
        //var_dump($this->projectTypes);
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
        // Adding CSS and JS
        $document = JFactory::getDocument();
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/masterChest.css");
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/optionsChest.css");
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/projectcreate.css");
    }

    /**
     * // TODO comment
     * @since 0.2.6
     */
    private function addScripts()
    {
        // Adding CSS and JS
        $document = JFactory::getDocument();
        $document->addScript(JURI::root() . "media/com_progresstool/js/projectcreate.js");
    }
}