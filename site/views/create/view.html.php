<?php defined('_JEXEC') or die;

/**
 * (Site) Class ProgressToolViewCreate
 *
 * View for front-end create functionality.
 *
 * @package ProgressTool
 * @subpackage site
 * @since 0.5.0
 *
 * @author  Morgan Nolan <morgan.nolan@hotmail.com>
 * @link    https://github.com/morghayn
 */
class ProgressToolViewCreate extends JViewLegacy
{
    protected $form = null;

    /**
     * Display the project creator view.
     *
     * @param string $tpl The name of the layout file to parse.
     * @return  void
     * @since 0.5.0
     */
    public function display($tpl = null)
    {
        JLoader::register('Auth',  JPATH_BASE . '/components/com_progresstool/helpers/Auth.php');
        Auth::redirectGuests();

        $this->initForm(JFactory::getUser()->id);
        $this->prepareDocument();
        parent::display($tpl);
    }

    /**
     * Initializes project form.
     *
     * @param $userID
     * @since 0.5.0
     */
    public function initForm($userID)
    {
        $model = JModelLegacy::getInstance('Project', 'ProgressToolModel');
        $groupsQuery = $model->getGroupsQuery($userID);
        $this->form = $model->getForm();
        $this->form->setFieldAttribute('group', 'query', $groupsQuery);
    }

    /**
     * Prepares document by adding stylesheets and scripts.
     *
     * @since 0.5.0
     */
    protected function prepareDocument()
    {
        $document = JFactory::getDocument();
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/site/project.css");
        $document->addScript(JURI::root() . "media/com_progresstool/js/site/project.js");
    }
}