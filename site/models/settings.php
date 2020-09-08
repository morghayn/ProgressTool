<?php defined('_JEXEC') or die;

/**
 * (Site) Class ProgressToolModelSettings
 *
 * Model for front-end project settings functionality.
 *
 * @package ProgressTool
 * @subpackage site
 * @since 0.5.0
 *
 * @author  Morgan Nolan <morgan.nolan@hotmail.com>
 * @link    https://github.com/morghayn
 */
class ProgressToolModelSettings extends JModelAdmin
{
    public function getGroupsQuery($userID)
    {
        return (
            'SELECT CG.id, CG.name ' .
            'FROM #__community_groups AS CG ' .
            'INNER JOIN #__community_groups_members AS CGM ON CG.id = CGM.groupid ' .
            'WHERE memberid = ' . $userID . ' AND CGM.permissions = 1 '
        );
    }

    /**
     * Updates the information of a project. // TODO: document
     *
     * @param $data
     * @return mixed
     */
    public function update($data)
    {
        $projectID = $data['projectID'];
        $name = $data['name'];
        $description = $data['description'];
        $type = $data['type'];
        $groupID = $data['group'];

        $db = JFactory::getDbo();
        $update = $db->getQuery(true);

        $set = array(
            $db->quoteName('group_id') . ' = ' . $db->quote($groupID),
            $db->quoteName('name') . ' = ' . $db->quote($name),
            $db->quoteName('description') . ' = ' . $db->quote($description),
            $db->quoteName('type_id') . ' = ' . $db->quote($type)
        );

        $update
            ->update($db->quoteName('#__pt_project'))
            ->set($set)
            ->where($db->quoteName('id') . ' = ' . $db->quote($projectID));

        return $db->setQuery($update)->execute();
    }

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

        $columns = array('group_id', 'name', 'description', 'type_id');

        $query
            ->select($db->quoteName($columns))
            ->from($db->quoteName('#__pt_project'))
            ->where($db->quoteName('id') . ' = ' . $db->quote($projectID))
            ->setLimit(1);

        return $db->setQuery($query)->loadObjectList();
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