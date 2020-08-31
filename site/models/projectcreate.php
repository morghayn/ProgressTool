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

        /* Try using JTable here
        // retrieve all table objects needed to store form data
        $tbl_employer = $this->getTable('Employer');
        $tbl_contact = $this->getTable('Contact', 'RgtMyraTable', array());

        if($tbl_employer){
            $tbl_employer->industries_id = $data['industry'];
        }
        else{
            $this->setError("Error getting employer table");
            return false;
        }

        // Store the data.
        if (!$tbl_employer->save($data))
        {
            $this->setError("Error saving into employer table");
            return false;
        }
        */
    }

    /*
     * Method to get a table object, load it if necessary.
     *
     * @param string $type The table name. Optional.
     * @param string $prefix The class prefix. Optional.
     * @param array $config Configuration array for model. Optional.
     *
     * @return  JTable  A JTable object
     *
     * @since   1.6
     */
    /* // TODO: probably need
    public function getTable($type = 'project', $prefix = 'pt_', $config = array())
    {
        return JTable::getInstance($type, $prefix, $config);
    }
    */

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
        return JFactory::getApplication()->getUserState('com_progresstool.edit.projectcreate.data', array());
    }

    /**
     * Method to get the script that have to be included on the form
     * This returns the script associated with projectcreate field name validation
     *
     * @return string    Script files
     */
    public function getScript()
    {
        return 'media/com_progresstool/forms/projectcreate.js';
    }
}