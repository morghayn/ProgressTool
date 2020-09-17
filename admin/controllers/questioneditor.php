<?php defined('_JEXEC') or die;

/**
 * (Admin) Class ProgressToolControllerQuestionEditor
 *
 * Controller for back-end question editor functionality.
 *
 * @package ProgressTool
 * @subpackage admin
 * @since 0.5.0
 *
 * @author  Morgan Nolan <morgan.nolan@hotmail.com>
 * @link    https://github.com/morghayn
 */
class ProgressToolControllerQuestionEditor extends JControllerLegacy
{
    public function updateQuestion()
    {
        //JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

        $model = $this->getModel('questionEditor');
        $app = JFactory::getApplication();
        $input = $app->input;
        $questionID = $input->getInt('questionID', 0);
        $question = $input->get('question', '', 'string');

        if ($model->updateQuestion($questionID, $question))
        {
            $app->enqueueMessage("Question updated successfully");
        }
        else
        {
            $app->enqueueMessage("Failed to update question");
        }

        $this->setRedirect('index.php?option=com_progresstool&view=questionEditor');
    }

    public function updateQuestionChoices()
    {
        //JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

        //$model = $this->getModel('beginner');
        $app = JFactory::getApplication();
        $input = $app->input;
        $choices = $input->get('choices', array(), 'array');

        $testingChoices = '';

        foreach ($choices as $key => $choice)
        {
            $testingChoices .= '\n' . $key . '. ' . $choice;
        }

        $app->enqueueMessage("updateQuestionChoices() $testingChoices");
        $this->setRedirect('index.php?option=com_progresstool&view=questionEditor');
    }

    public function updateIcon()
    {
        $app = JFactory::getApplication();
        $app->enqueueMessage("updateIcon()");
        $this->setRedirect('index.php?option=com_progresstool&view=questionEditor');
    }

    public function addChoice()
    {
        $model = $this->getModel('questionEditor');
        $app = JFactory::getApplication();
        $input = $app->input;
        $questionID = $input->getInt('questionID', 0);

        if($model->addChoice($questionID))
        {
            $app->enqueueMessage("Choice added");
        }
        else
        {
            $app->enqueueMessage("Failed to add choice");
        }

        $this->setRedirect('index.php?option=com_progresstool&view=questionEditor');
    }

    public function deleteChoice()
    {
        $model = $this->getModel('questionEditor');
        $app = JFactory::getApplication();
        $input = $app->input;
        //$questionID = $input->getInt('questionID', 0);

        /**
        if($model->addChoice($questionID))
        {
            $app->enqueueMessage("Choice added");
        }
        else
        {
            $app->enqueueMessage("Failed to add choice");
        }
        */

        $app->enqueueMessage("deleteChoice()");
        $this->setRedirect('index.php?option=com_progresstool&view=questionEditor');
    }

    public function removeIcon()
    {
        $model = $this->getModel('questionEditor');
        $app = JFactory::getApplication();
        $input = $app->input;
        //$questionID = $input->getInt('questionID', 0);

        /**
        if($model->addChoice($questionID))
        {
        $app->enqueueMessage("Choice added");
        }
        else
        {
        $app->enqueueMessage("Failed to add choice");
        }
         */

        $app->enqueueMessage("removeIcon()");
        $this->setRedirect('index.php?option=com_progresstool&view=questionEditor');
    }
}