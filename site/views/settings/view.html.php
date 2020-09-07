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
        $model = parent::getModel();
        $input = JFactory::getApplication()->input;

        $projectID = $input->get('projectID', 1);
        $project = $model->getProject($projectID)[0];
        $assoc = array(
            "projectID" => $projectID,
            "name" => $project->name,
            "description" => $project->description,
            "type" => $project->type_id
        );

        // Get the form to display
        $this->form = $this->get('Form');
        $this->form->bind($assoc);

        // Call the parent display to display the layout file
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
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/projectcreate.css");
        $document->addScript(JURI::root() . "media/com_progresstool/forms/projectcreate.js");
        $document->addScript(JURI::root() . "media/com_progresstool/forms/submitbutton.js");
    }
}