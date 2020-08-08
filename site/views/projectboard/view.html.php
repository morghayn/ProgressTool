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
 * @license GNU General Public License version 2 or later; see LICENSE.txt
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
        if ($this->user->get('guest')) {
            $return = urlencode(base64_encode('index.php?option=com_progresstool&view=survey'));
            $this->redirect = "index.php?option=com_users&view=login&return=" . $return;
        } else {
            $this->redirect = "index.php?option=com_progresstool&view=survey";
        }


        // TODO: Fetch User
        $user_id = 1;

        // TODO: Fetch User Projects
        $model = $this->getModel();
        $this->user_projects = array();
        $this->user_projects = $model->getUserProjects($user_id);

        // TODO: Generate Project Graph

        // Adding stylesheet.
        $document = JFactory::getDocument();
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/projectboard.css");
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/masterChest.css");
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/optionsChest.css");

        // Display the view
        parent::display($tpl);
    }
}