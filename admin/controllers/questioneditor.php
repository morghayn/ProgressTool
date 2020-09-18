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
        JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

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
        JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

        $model = $this->getModel('questionEditor');
        $app = JFactory::getApplication();
        $input = $app->input;
        $choices = $input->get('choices', array(), 'array');

        if ($model->updateChoices($choices))
        {
            $app->enqueueMessage("Successfully updated the choices.");
        }
        else
        {
            $app->enqueueMessage("Failed to update the choices.");
        }

        $this->setRedirect('index.php?option=com_progresstool&view=questionEditor');
    }

    public function addChoice()
    {
        // TODO: JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

        $model = $this->getModel('questionEditor');
        $app = JFactory::getApplication();
        $input = $app->input;
        $questionID = $input->getInt('questionID', 0);

        if ($model->addNewChoice($questionID))
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
        // TODO: JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

        $model = $this->getModel('questionEditor');
        $app = JFactory::getApplication();
        $input = $app->input;
        $choiceID = $input->getInt('choiceID', 0);

        if ($model->deleteChoice($choiceID))
        {
            $app->enqueueMessage("Choice deleted");
        }
        else
        {
            $app->enqueueMessage("Failed to delete choice");
        }

        $this->setRedirect('index.php?option=com_progresstool&view=questionEditor');
    }

    public function updateIcon()
    {
        JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
        $model = $this->getModel('questionEditor');
        $app = JFactory::getApplication();
        $input = $app->input;
        $data = $input->get('icon', array(), 'ARRAY');
        $questionID = $input->getInt('questionID', 0);
        $file = $input->files->get('file_upload');

        if ($file)
        {
            // Cleans the name of teh file by removing weird characters
            $filename = JFile::makeSafe($file['name']);

            $src = $file['tmp_name'];
            $filePath = '/media/com_progresstool/icons/' . $filename;
            $dest = JPATH_SITE . '/media/com_progresstool/icons/' . $filename;

            if (JFile::upload($src, $dest))
            {
                list($width, $height) = getimagesize(JPATH_SITE . $filePath);
                $model->addIcon($questionID, $filePath, $width, $height);
                $app->enqueueMessage(':)');
                $this->setRedirect('index.php?option=com_progresstool&view=questionEditor');
            }
            else
            {
                $app->enqueueMessage(':(');
                $this->setRedirect('index.php?option=com_progresstool&view=questionEditor');
            }
        }
        else
        {
            if ($model->updateIcon($data, $questionID))
            {
                $app->enqueueMessage(':)');
                $this->setRedirect('index.php?option=com_progresstool&view=questionEditor');
            }
            else
            {
                $app->enqueueMessage(':(');
                $this->setRedirect('index.php?option=com_progresstool&view=questionEditor');
            }
        }
    }

    public function deleteIcon()
    {
        //TODO: JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

        $model = $this->getModel('questionEditor');
        $app = JFactory::getApplication();
        $input = $app->input;
        $questionID = $input->getInt('questionID', 0);


        if ($model->deleteIcon($questionID))
        {
            $app->enqueueMessage("Icon removed");
        }
        else
        {

            $app->enqueueMessage("Failed to remove icon");
        }

        $this->setRedirect('index.php?option=com_progresstool&view=questionEditor');
    }
}