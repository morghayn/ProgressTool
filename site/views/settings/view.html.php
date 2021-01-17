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
    private $userID;

    /**
     * Renders template for the Settings view.
     *
     * @param string $tpl The name of the layout file to parse.
     * @since 0.5.0
     */
    public function display($tpl = null)
    {
        $input = JFactory::getApplication()->input;
        $projectID = $input->get('projectID', 0);
        $this->userID = JFactory::getUser()->id;

        if ($projectID !== 0)
        {
            $this->initPrefillForm($projectID);
        }
        else
        {
            $this->onErrorPrefillForm();
        }

        $this->prepareDocument();
        parent::display($tpl);
    }

    /**
     * Method used to setup form on initial load.
     *
     * @param $projectID
     * @since 0.5.0
     */
    private function initPrefillForm($projectID)
    {
        JLoader::register('Auth', JPATH_BASE . '/components/com_progresstool/helpers/Auth.php');
        Auth::authorize($projectID);

        $model = parent::getModel();
        $groupsQuery = $model->getGroupsQuery($this->userID);
        $project = $model->getProject($projectID);
        $this->form = $this->get('Form');
        $this->form->setFieldAttribute('group', 'query', $groupsQuery);
        $this->form->bind($project);
    }

    /**
     * Method used to setup form when an error occurs. Such as a validation error.
     *
     * @since 0.5.0
     */
    private function onErrorPrefillForm()
    {
        $model = parent::getModel();
        $groupsQuery = $model->getGroupsQuery($this->userID);
        $this->form = $this->get('Form');
        $this->form->setFieldAttribute('group', 'query', $groupsQuery);
    }

    /**
     * Prepares document by adding stylesheets and scripts.
     *
     * @since 0.5.0
     */
    private function prepareDocument()
    {
        $document = JFactory::getDocument();
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/site/settings.css");
        $document->addScript(JURI::root() . "media/com_progresstool/js/site/settings.js");
    }
}