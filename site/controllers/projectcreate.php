<?php

/**
 * (Site) Class ProgressToolControllerProjectCreate
 *
 * Controller for back-end projectcreate functionality.
 *
 * @package ProgressTool
 * @subpackage admin
 * @since 0.5.0
 *
 * @author  Morgan Nolan <morgan.nolan@hotmail.com>
 * @link    https://github.com/morghayn
 */
class ProgressToolControllerProjectCreate extends JControllerForm
{
    public function cancel($key = null)
    {
        // TODO: probably need this at some stage parent::cancel($key);

        // set up the redirect back to the same form
        $app = JFactory::getApplication();
        $this->setRedirect('index.php?option=com_progresstool&view=projectboard', 'You cancelled creating a form.');
    }

    /*
     * Function handing the save for adding a new helloworld record
     * Based on the save() function in the JControllerForm class
     */
    public function save($key = null, $urlVar = null)
    {
        // Check for request forgeries.
        JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

        $app = JFactory::getApplication();
        $input = $app->input;
        $model = $this->getModel('projectcreate');

        // Get the current URI to set in redirects. As we're handling a POST,
        // this URI comes from the <form action="..."> attribute in the layout file above
        $currentUri = (string)JUri::getInstance();

        // get the data from the HTTP POST request
        $data = $input->get('jform', array(), 'array');

        // set up context for saving form data
        $context = "$this->option.$this->context";

        // save the form data and set up the redirect back to the same form,
        // to avoid repeating them under every error condition
        $app->setUserState($context . '.data', $data);
        $this->setRedirect($currentUri);

        // Validate the posted data.
        // First we need to set up an instance of the form ...
        $form = $model->getForm($data, false);

        if (!$form)
        {
            $app->enqueueMessage($model->getError(), 'error');
            return false;
        }

        // ... and then we validate the data against it
        // The validate function called below results in the running of the validate="..." routines
        // specified against the fields in the form xml file, and also filters the data
        // according to the filter="..." specified in the same place (removing html tags by default in strings)
        $validData = $model->validate($form, $data);

        // Handle the case where there are validation errors
        if ($validData === false)
        {
            // Get the validation messages.
            $errors = $model->getErrors();

            // Display up to three validation messages to the user.
            for ($i = 0, $n = count($errors); $i < $n && $i < 3; $i++)
            {
                if ($errors[$i] instanceof Exception)
                {
                    $app->enqueueMessage($errors[$i]->getMessage(), 'warning');
                }
                else
                {
                    $app->enqueueMessage($errors[$i], 'warning');
                }
            }

            return false;
        }

        // Attempt to save the data.
        if (!$model->save($validData))
        {
            // Handle the case where the save failed

            // Save the data in the session.
            $app->setUserState($context . '.data', $validData);

            // Redirect back to the edit screen.
            $this->setError(JText::sprintf('JLIB_APPLICATION_ERROR_SAVE_FAILED', $model->getError()));
            $this->setMessage($this->getError(), 'error');

            $this->setRedirect($currentUri);

            return false;
        }

        // clear the data in the form
        $app->setUserState($context . '.data', null);

        // redirect success
        $this->setRedirect('index.php?option=com_progresstool&view=projectboard', 'New project created successfully');
        return true;
    }

}