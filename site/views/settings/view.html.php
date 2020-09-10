<?php defined('_JEXEC') or die;

/**
 * (Site) Class ProgressToolViewSettings
 *
 * View for front-end settings functionality.
 *
 * @package ProgressTool
 * @subpackage site
 * @since 0.5.0
 *
 * @author  Morgan Nolan <morgan.nolan@hotmail.com>
 * @link    https://github.com/morghayn
 */
class ProgressToolViewSettings extends JViewLegacy
{
    protected $form = null;

    /**
     * Renders template for the Settings view.
     *
     * @param string $tpl The name of the layout file to parse.
     */
    public function display($tpl = null)
    {
        $input = JFactory::getApplication()->input;
        $projectID = $input->get('projectID', 1);

        JLoader::register('Authenticator',  JPATH_BASE . '/components/com_progresstool/helpers/authenticator.php');
        Authenticator::authenticate($projectID);

        $model = parent::getModel();
        $userID = JFactory::getUser()->id;
        $groupsQuery = $model->getGroupsQuery($userID);
        $project = $model->getProject($projectID);

        $this->form = $this->get('Form');
        $this->form->setFieldAttribute('group', 'query', $groupsQuery);
        $this->form->bind($project);

        parent::display($tpl);
        $this->prepareDocument();
    }

    /**
     * Prepares document by adding stylesheets and scripts.
     *
     * @since 0.5.0
     */
    protected function prepareDocument()
    {
        $document = JFactory::getDocument();
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/projectform.css");
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/introductory.css");
        $document->addScript(JURI::root() . "media/com_progresstool/forms/projectcreate.js");
        $document->addScript(JURI::root() . "media/com_progresstool/forms/submitbutton.js");
    }
}