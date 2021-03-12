<?php defined('_JEXEC') or die;

/**
 * (Admin) Class ProgressToolControllerTasks
 *
 * Controller for back-end tasks functionality.
 *
 * @package ProgressTool
 * @subpackage admin
 * @since 0.5.0
 *
 * @author  Morgan Nolan <morgan.nolan@hotmail.com>
 * @link    https://github.com/morghayn
 */
class ProgressToolControllerTasks extends JControllerLegacy
{
    public function updateTask()
    {
        JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

        $model = $this->getModel('tasks');
        $app = JFactory::getApplication();
        $input = $app->input;

        $taskID = $input->getInt('taskID', 0);
        $text = $input->getString('text', '');

        echo json_encode(
            array(
                "status" => (!$model->updateTask($taskID, $text) ? "failure" : "success")
            )
        );
    }

    public function removeChoice()
    {
        JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

        $model = $this->getModel('tasks');
        $app = JFactory::getApplication();
        $input = $app->input;

        $countryID = $input->getInt('countryID', 0);
        $taskID = $input->getInt('taskID', 0);
        $choiceID = $input->getInt('choiceID', 0);

        echo json_encode(
            array(
                "status" => (!$model->removeChoice($countryID, $taskID, $choiceID) ? "failure" : "success")
            )
        );
    }

    public function updateLogicID()
    {
        JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

        $model = $this->getModel('tasks');
        $app = JFactory::getApplication();
        $input = $app->input;

        $countryID = $input->getInt('countryID', 0);
        $taskID = $input->getInt('taskID', 0);
        $logicID = $input->getInt('logicID', 0);

        echo json_encode(
            array(
                "status" => (!$model->updateLogicID($countryID, $taskID, $logicID) ? "failure" : "success")
            )
        );
    }

    public function addChoice()
    {
        JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

        $model = $this->getModel('tasks');
        $app = JFactory::getApplication();
        $input = $app->input;

        $countryID = $input->getInt('countryID', 0);
        $taskID = $input->getInt('taskID', 0);
        $choiceID = $input->getInt('choiceID', 0);

        echo json_encode(
            array(
                "status" => (!$model->addChoice($countryID, $taskID, $choiceID) ? "failure" : "success")
            )
        );
    }
}