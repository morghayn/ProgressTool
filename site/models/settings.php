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
class ProgressToolModelSettings extends JModelAdmin
{
    /**
     * Returns associated array containing data pertaining to the project specified in the parameters.
     *
     * @param int $projectID the ID used to identify project.
     * @return mixed associated array of data.
     * @since 0.3.0
     */
    public function getProject($projectID)
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        $columns = array('name', 'description', 'type_id');

        $query
            ->select($db->quoteName($columns))
            ->from($db->quoteName('#__pt_project'))
            ->where($db->quoteName('id') . ' = ' . $db->quote($projectID))
            ->setLimit(1);

        return $db->setQuery($query)->loadObjectList();
    }

    /**
     * Updates the information of a project.
     *
     * @param int $projectID ID of the project.
     * @param string $name updated name.
     * @param string $description updated description.
     * @return bool status of whether the update was a success or not.
     */
    public function update($data)
    {
        $projectID = $data['projectID'];
        $name = $data['name'];
        $description = $data['description'];
        $type = $data['type'];

        $db = JFactory::getDbo();
        $update = $db->getQuery(true);

        $set = array(
            $db->quoteName('name') . ' = ' . $db->quote($name),
            $db->quoteName('description') . ' = ' . $db->quote($description)
        );

        $update
            ->update($db->quoteName('#__pt_project'))
            ->set($set)
            ->where($db->quoteName('id') . ' = ' . $db->quote($projectID));

        return $db->setQuery($update)->execute();
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
        return JFactory::getApplication()->getUserState('com_progresstool.settings.data', array());
    }

    /**
     * Deletes a project. Deletion is setup to cascade so do not worry about referential integrity.
     *
     * @param int $projectID the ID of the project.
     * @since 0.5.0
     */
    public function deleteProject($projectID)
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        $query
            ->delete($db->quoteName('#__project'))
            ->where($db->quoteName('project_id') . ' = ' . $projectID);

        $result = $db->setQuery($query)->execute();
    }
}