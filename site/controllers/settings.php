<?php defined('_JEXEC') or die;

/**
 * (Site) Class ProgressToolControllerSettings
 *
 * Controller for back-end settings functionality.
 *
 * @package ProgressTool
 * @subpackage admin
 * @since 0.5.0
 *
 * @author  Morgan Nolan <morgan.nolan@hotmail.com>
 * @link    https://github.com/morghayn
 */
class ProgressToolControllerSettings extends JControllerForm
{
    public function update($key = null, $urlVar = null)
    {
        JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
        $model = $this->getModel('settings');
        $app = JFactory::getApplication();
        $input = $app->input;
        $data = $input->get('jform', array(), 'array');

        // Save the form data in user state variable and setup redirect
        $currentUri = (string)JUri::getInstance();
        $context = "$this->option.$this->context.data";
        $app->setUserState($context, $data);
        $this->setRedirect($currentUri);

        // Setting up form to validate data
        $form = $model->getForm($data, false);
        if (!$form)
        {
            $app->enqueueMessage($model->getError(), 'error');
            return false;
        }

        // Validating date using form we setup
        // If unsuccessful, we enqueue validation errors and redirect back to form
        $validData = $model->validate($form, $data);
        if ($validData === false)
        {
            $errors = $model->getErrors();

            foreach ($errors as $error)
            {
                if ($error instanceof \Exception)
                {
                    $app->enqueueMessage($error->getMessage(), 'warning');
                }
                else
                {
                    $app->enqueueMessage($error, 'warning');
                }
            }

            return false;
        }

        // Updating project details
        // If unsuccessful, we save the valid data to the user session and redirect back to form
        $isUpdateSuccessful = $model->update(
            $data['projectID'],
            $data['name'],
            $data['description'],
            $data['type'],
            $data['group']
        );
        if (!$isUpdateSuccessful)
        {
            $app->setUserState($context, $validData);
            $this->setError(JText::sprintf('JLIB_APPLICATION_ERROR_SAVE_FAILED', $model->getError()));
            $this->setMessage($this->getError(), 'error');
            return false;
        }

        // Clear the data in the form and redirect
        $app->setUserState($context, null);
        $this->setRedirect('index.php?option=com_progresstool&view=projectboard', 'Project has been updated successfully');
        return true;
    }
}