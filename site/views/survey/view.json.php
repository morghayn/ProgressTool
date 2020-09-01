<?php defined('_JEXEC') or die;

/**
 * Class ProgressToolViewSurvey
 *
 * Handling JSON responses for AJAX requests client-side
 *
 * @package ProgressTool
 * @subpackage site
 * @since 0.1.7
 *
 * @author  Morgan Nolan <morgan.nolan@hotmail.com>
 * @link    https://github.com/morghayn
 */
class ProgressToolViewSurvey extends JViewLegacy
{
    /**
     * Returns JSON test response
     *
     * @param null $tpl use default template.
     * @since 0.1.7
     */
    function display($tpl = null)
    {
        // todo integration of fetching the projectid :: ?? i don't know what was i on about here
        $input = JFactory::getApplication()->input;
        $data = $input->get('data', array(), 'ARRAY');

        $projectID = $data['projectID'];
        $choiceID = $data['choiceID'];

        $status = parent::getModel()->processSelection($projectID, $choiceID);
        echo new JResponseJson($status);
    }
}