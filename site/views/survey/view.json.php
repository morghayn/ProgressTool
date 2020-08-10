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
 * @license GNU General Public License version 2 or later; see LICENSE.txt
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
        // todo integration of fetching the projectid
        $input = JFactory::getApplication()->input;
        $data = $input->get('data', array(), 'ARRAY');

        /*
        if($data['projectID'])
        {
            $projectID = urlencode(base64_encode($data['projectID']));
            $surveyRedirect = 'index.php?option=com_progresstool&view=survey&project=' . $projectID;
            $respon = array("redirect"=>$surveyRedirect);
            //JFactory::getApplication()->redirect(JRoute::_($respon, false));
            echo new JResponseJson($respon);
        }
        else
        {
            echo new JResponseJson('No projectID received');
        }
        */

        // todo this might not be safe, might have to specify type e.g get(array, array(), 'ARRAY')
        //$choiceID = $input->get('choice');
        //$projectID = 2;
        $projectID = $data['projectID'];
        $choiceID = $data['choiceID'];

        $input = JFactory::getApplication()->input;

        // TODO does PHP have booleans?
        $model = $this->getModel();

        $isSelected = $model->isSelected($projectID, $choiceID);
        if ($isSelected == 1)
        {
            $model->deselect($projectID, $choiceID);
        }
        else if ($isSelected == 0)
        {
            $model->select($projectID, $choiceID);
        }
        /*
        // getting details about choice selection
        // todo maybe merge the queries for $questionID and $model
        $questionID = $model->getQuestionID($choiceID);
        $weight = $model->getWeight($choiceID);

        // inserting our data
        $model->select($projectID, $choiceID);

        if ($weight == "0")
        {
            // todo select all where weight is greater than 0
            // todo delete all where weight is great than 0
            $questionID .= "0";
        }
        else
        {
            // todo select all where weight is less than 1
            // todo delete all where weight is less than 1
            $questionID .= "1";
        }
        */

        // responding with data
        echo new JResponseJson($isChecked);
    }
}