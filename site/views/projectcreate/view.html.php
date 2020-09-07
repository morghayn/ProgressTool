<?php defined('_JEXEC') or die;

/**
 * (Site) Class ProgressToolViewProjectCreate
 *
 * View for front-end projectcreate functionality.
 *
 * @package ProgressTool
 * @subpackage site
 * @since 0.5.0
 *
 * @author  Morgan Nolan <morgan.nolan@hotmail.com>
 * @link    https://github.com/morghayn
 */
class ProgressToolViewProjectCreate extends JViewLegacy
{
    protected $form = null;

    /**
     * Display the Hello World view
     *
     * @param string $tpl The name of the layout file to parse.
     *
     * @return  void
     */
    public function display($tpl = null)
    {
        $user = JFactory::getUser();
        $model = parent::getModel();

        // Get the form to display
        $this->form = $this->get('Form');
        $groupsQuery = $model->getGroupsQuery($user->id);
        $this->form->setFieldAttribute('group', 'query', $groupsQuery);

        // Call the parent display to display the layout file
        parent::display($tpl);

        // Set properties of the html document
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
        $document->addScript(JURI::root() . "media/com_progresstool/forms/submitbutton.js");
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/projectcreate.css");
    }
}