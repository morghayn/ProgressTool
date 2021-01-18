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
    protected $form = null, $project;

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

        JLoader::register('Auth', JPATH_BASE . '/components/com_progresstool/helpers/Auth.php');
        Auth::authorize($projectID);

        $this->initForm($projectID, JFactory::getUser()->id);
        $this->prepareDocument();
        parent::display($tpl);
    }

    /**
     * Initializes project form.
     *
     * @param $projectID
     * @param $userID
     * @since 0.5.0
     */
    private function initForm($projectID, $userID)
    {
        $model = JModelLegacy::getInstance('Project', 'ProgressToolModel');
        $groupsQuery = $model->getGroupsQuery($userID);
        $this->project = $model->getProject($projectID);

        $this->form = $model->getForm();
        $this->form->setFieldAttribute('group_id', 'query', $groupsQuery);
        $this->form->bind($this->project);
    }

    /**
     * Prepares document by adding stylesheets and scripts.
     *
     * @since 0.5.0
     */
    private function prepareDocument()
    {
        $document = JFactory::getDocument();
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/site/project.css");
        $document->addScript(JURI::root() . "media/com_progresstool/js/site/project.js");
    }
}