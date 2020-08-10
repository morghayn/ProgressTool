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
 * @license GNU General Public License version 2 or later; see LICENSE.txt
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
        /*
        // todo integration of fetching the projectid
        $projectID = 2;

        $input = JFactory::getApplication()->input;
        // todo this might not be safe, might have to specify type e.g get(array, array(), 'ARRAY')
        $choiceID = $input->get('choice');

        // TODO does PHP have booleans?
        $model = $this->getModel();
        $isChecked = $model->checkSelected($projectID, $choiceID);
        if ($isChecked == 1)
        {
            $model->deselect($projectID, $choiceID);
        }
        else if ($isChecked == 0)
        {
            $model->insertProjectQuestionChoice($projectID, $choiceID);
        }
        */
        /*
        // getting details about choice selection
        // todo maybe merge the queries for $questionID and $model
        $questionID = $model->getQuestionID($choiceID);
        $weight = $model->getWeight($choiceID);

        // inserting our data
        $model->insertProjectQuestionChoice($projectID, $choiceID);

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
        /*
         * echo new JResponseJson($isChecked);
         */
        //JFactory::getApplication()->redirect('index.php?option=com_progresstool&view=projectboard');
        // Todo not this type of redirect
        $this->user = JFactory::getUser();


        $input = JFactory::getApplication()->input;
        $projectData = $input->get('projectData', array(), 'ARRAY');

        $model = $this->getModel();
        $model->insertProject($this->user->id, $projectData['name'], $projectData['description']);


        echo new JResponseJson($projectData['name']);

        /*
        $redirect_url = 'index.php?option=com_progresstool&view=projectboard';
        JFactory::getApplication()->redirect(JRoute::_($redirect_url, false));
        */

    }
}