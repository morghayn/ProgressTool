<?php defined('_JEXEC') or die;

/**
 * (Site) Class ProgressToolControllerCreate
 *
 * Controller for back-end project form functionality.
 *
 * @package ProgressTool
 * @subpackage admin
 * @since 0.5.0
 *
 * @author  Morgan Nolan <morgan.nolan@hotmail.com>
 * @link    https://github.com/morghayn
 */
class ProgressToolControllerProject extends JControllerForm
{
    /**
     * Creates a new project entry using the data provided.
     *
     * @param null $key
     * @param null $urlVar
     * @return bool
     * @throws Exception
     * @since 0.5.0
     */
    public function create($key = null, $urlVar = null)
    {
        JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

        $model = $this->getModel('create');
        $app = JFactory::getApplication();
        $input = $app->input;
        $data = $input->get('jform', array(), 'array');

        // Save the form data in an user state variable and setup redirect
        $currentUri = (string)JUri::getInstance();
        $context = "$this->option.$this->context.data";
        $app->setUserState($context, $data);
        $this->setRedirect($currentUri);

        // Setting up form to validate data. If unsuccessful, we enqueue validation errors and redirect back to form
        $form = $model->getForm($data, false);
        if (!$form)
        {
            $app->enqueueMessage($model->getError(), 'error');
            return false;
        }

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

        // Attempt to save project. If unsuccessful, save the valid data and redirect back to form
        $isSaveSuccessful = $model->create(
            JFactory::getUser()->id,
            $data['name'],
            $data['description'],
            $data['type'],
            $data['group']
        );

        if (!$isSaveSuccessful)
        {
            $app->setUserState($context, $validData);
            $this->setError(JText::sprintf('JLIB_APPLICATION_ERROR_SAVE_FAILED', $model->getError()));
            $this->setMessage($this->getError(), 'error');
            return false;
        }

        // Task has been successful, clear the data in the form and redirect
        $app->setUserState($context, null);
        $this->setRedirect('index.php?option=com_progresstool&view=projectboard', 'New project created successfully');
        return true;
    }

    /**
     * Updates project details using the data provided.
     *
     * @param null $key
     * @param null $urlVar
     * @return bool
     * @throws Exception
     * @since 0.5.0
     */
    public function update($key = null, $urlVar = null)
    {
        JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

        $model = $this->getModel('settings');
        $app = JFactory::getApplication();
        $input = $app->input;
        $data = $input->get('jform', array(), 'array');

        // Authorizing update request
        JLoader::register('Auth', JPATH_BASE . '/components/com_progresstool/helpers/Auth.php');
        Auth::authorize($data['projectID']);

        // If form is accessed initially without a projectID specified
        if ($data['projectID'] === 0)
        {
            $app->enqueueMessage('Project does not exist', 'error');
            return false;
        }

        // Save the form data in an user state variable and setup redirect
        $currentUri = (string)JUri::getInstance();
        $context = "$this->option.$this->context.data";
        $app->setUserState($context, $data);
        $this->setRedirect($currentUri);

        // Setting up form to validate data. If unsuccessful, we enqueue validation errors and redirect back
        $form = $model->getForm($data, false);
        if (!$form)
        {
            $app->enqueueMessage($model->getError(), 'error');
            return false;
        }
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

        // Attempt to update project. If unsuccessful, save the valid data and redirect back to form
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

        // Task has been successful, clear the data in the form and redirect
        $app->setUserState($context, null);
        $this->setRedirect('index.php?option=com_progresstool&view=projectboard', 'Project has been updated successfully');
        return true;
    }

    public function deactivate()
    {

    }
}