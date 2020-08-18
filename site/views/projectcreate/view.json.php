<?php defined('_JEXEC') or die;

/**
 * Class ProgressToolViewProjectCreate
 *
 * Handling JSON responses for AJAX requests client-side
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
     * Returns JSON test response //todo proper description
     *
     * @param null $tpl use default template.
     * @since 0.2.6
     */
    function display($tpl = null)
    {
        $this->user = JFactory::getUser();


        $input = JFactory::getApplication()->input;
        $projectData = $input->get('projectData', array(), 'ARRAY');

        $model = parent::getModel();
        $model->insertProject($this->user->id, $projectData['name'], $projectData['description']);


        echo new JResponseJson($projectData['name']);
    }
}