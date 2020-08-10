<?php defined('_JEXEC') or die;

/**
 * Class ProgressToolViewProjectBoard
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
class ProgressToolViewProjectBoard extends JViewLegacy
{

    /**
     * Returns JSON test response //todo proper description
     *
     * @param null $tpl use default template.
     * @since 0.2.6
     */
    function display($tpl = null)
    {
        $input = JFactory::getApplication()->input;
        $data = $input->get('data', array(), 'ARRAY');
        $projectID = $data['project'];
        $preliminaryID = $data['preliminaryID'];

        $model = $this->getModel(); // TODO does PHP have booleans?
        $isSelected = $model->isSelected($projectID, $preliminaryID);

        if ($isSelected == 1)
        {
            $model->deselect($projectID, $preliminaryID);
        }
        else if ($isSelected == 0)
        {
            $model->select($projectID, $preliminaryID);
        }

        $isProjectValid = $model->isProjectValid(3, $projectID);
        if ($isProjectValid)
        {
            $model->activateProject($projectID);
        }


        $response = array("activated"=>$isProjectValid, "selected"=>$isSelected);
        echo new JResponseJson($response);
    }
}