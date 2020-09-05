<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_progresstool
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * HelloWorld Model
 *
 * @since  0.0.1
 */
class ProgressToolModelProjectCreate extends JModelAdmin
{

    /**
     * Overriding SAVE method
     * @param array $data (data from form)
     */
    public function save($data)
    {
        $user = JFactory::getUser();
        $userID = $user->id;
        $name = $data['name'];
        $description = $data['description'];
        $type = $data['type'];

        $db = JFactory::getDbo();
        $insert = $db->getQuery(true);

        $columns = array('user_id', 'name', 'description', 'type_id');
        $values = array($userID, $db->quote($name), $db->quote($description), $db->quote($type));

        $insert
            ->insert($db->quoteName('#__pt_project'))
            ->columns($db->quoteName($columns))
            ->values(implode(',', $values));

        return $db->setQuery($insert)->execute();
    }

    /**
     * Method to get the record form.
     *
     * @param array $data Data for the form.
     * @param boolean $loadData True if the form is to load its own data (default case), false if not.
     *
     * @return  mixed    A JForm object on success, false on failure
     *
     * @since   1.6
     */
    public function getForm($data = array(), $loadData = true)
    {
        // Get the form.
        $form = $this->loadForm(
            'com_progresstool.projectcreate',
            'project-creation-form',
            array(
                'control' => 'jform',
                'load_data' => $loadData
            )
        );

        if (empty($form)) {
            $errors = $this->getErrors();
            throw new Exception(implode("\n", $errors), 500);
        }

        return $form;
    }

    /**
     * Method to get the data that should be injected in the form.
     * As this form is for add, we're not prefilling the form with an existing record
     * But if the user has previously hit submit and the validation has found an error,
     *   then we inject what was previously entered.
     *
     * @return  mixed  The data for the form.
     *
     * @since   1.6
     */
    protected function loadFormData()
    {
        // Check the session for previously entered form data.
        return JFactory::getApplication()->getUserState('com_progresstool.projectcreate.data', array());
    }
}