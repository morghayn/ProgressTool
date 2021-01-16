<?php defined('_JEXEC') or die;

/**
 * (Site) Class ProgressToolControllerCreate
 *
 * Controller for back-end project creation functionality.
 *
 * @package ProgressTool
 * @subpackage admin
 * @since 0.5.0
 *
 * @author  Morgan Nolan <morgan.nolan@hotmail.com>
 * @link    https://github.com/morghayn
 */
class ProgressToolControllerCreate extends JControllerForm
{
    public function save($key = null, $urlVar = null)
    {
        JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

        $model = $this->getModel('create');
        $app = JFactory::getApplication();
        $input = $app->input;
        $data = $input->get('jform', array(), 'array');

        $currentUri = (string)JUri::getInstance();
        $context = "$this->option.$this->context.data";

        // save the form data and set up the redirect back to the same form, to avoid repeating them under every error condition
        $app->setUserState($context, $data);
        $this->setRedirect($currentUri);

        // Validate the posted data. First we need to set up an instance of the form ...
        $form = $model->getForm($data, false);
        if (!$form)
        {
            $app->enqueueMessage($model->getError(), 'error');
            return false;
        }

        $validData = $model->validate($form, $data);
        if ($validData === false)
        {
            // Get the validation messages.
            $errors = $model->getErrors();

            // Display up to three validation messages to the user.
            for ($i = 0, $n = count($errors); $i < $n && $i < 3; $i++)
            {
                $app->enqueueMessage(
                    ($errors[$i] instanceof Exception ? $errors[$i]->getMessage() : $errors[$i]),
                    'warning'
                );
            }

            return false;
        }

        // Attempt to save the data else handle the case where the save failed.
        if (!$model->save($validData))
        {
            // Save the data in the session.
            $app->setUserState($context, $validData);

            // Redirect back to the edit screen.
            $this->setError(JText::sprintf('JLIB_APPLICATION_ERROR_SAVE_FAILED', $model->getError()));
            $this->setMessage($this->getError(), 'error');
            $this->setRedirect($currentUri);
            return false;
        }

        // clear the data in the form and redirect
        $app->setUserState($context, null);
        $this->setRedirect('index.php?option=com_progresstool&view=projectboard', 'New project created successfully');
        return true;
    }
}