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
    public function removeChoice()
    {
        JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
        $model = $this->getModel('tasks');

        $app = JFactory::getApplication();
        $input = $app->input;
        $taskID = $input->getInt('taskID', 0);
        $choiceID = $input->getInt('choiceID', 0);

        /*
        if (!$model->updateQuestion($questionID, $question))
        {
            $app->enqueueMessage("Failed to update question");
        }


        $this->setRedirect(
            "index.php?option=com_progresstool&view=questionEditor&questionID=$questionID"
        );
        */

        echo json_encode(
            array(
                "taskID" => $taskID,
                "choiceID" => $choiceID
            )
        );
    }
}