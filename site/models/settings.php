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
     * Updates the project details for the project specified using the POSTed data.
     *
     * @param $projectID
     * @param $name
     * @param $description
     * @param $type
     * @param $groupID
     * @return mixed
     * @since 0.5.0
     */
    public function update($projectID, $name, $description, $type, $groupID)
    {
        $db = JFactory::getDbo();
        $update = $db->getQuery(true);

        $update
            ->update($db->quoteName('#__pt_project'))
            ->set(
                array(
                    $db->quoteName('name') . ' = ' . $db->quote($name),
                    $db->quoteName('description') . ' = ' . $db->quote($description),
                    $db->quoteName('type_id') . ' = ' . $db->quote($type),
                    $db->quoteName('group_id') . ' = ' . $db->quote($groupID)
                )
            )
            ->where($db->quoteName('id') . ' = ' . $db->quote($projectID));

        return $db->setQuery($update)->execute();
    }

    /**
     * Returns associated array containing data pertaining to the project specified in the parameters.
     *
     * @param int $projectID the ID used to identify project.
     * @return array associated array of data.
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

        $project = $db->setQuery($query)->loadObjectList()[0];
        return array(
            "projectID" => $projectID,
            "name" => $project->name,
            "description" => $project->description,
            "type" => $project->type_id,
            "group" => $project->group_id
        );
    }

    /**
     * Retrieves the form.
     *
     * @param array $data
     * @param boolean $loadData true if the form is to load its own data, false if not
     * @return  mixed JForm object on success, false on failure
     * @throws Exception
     * @since   0.5.0
     */
    public function getForm($data = array(), $loadData = true)
    {
        $form = $this->loadForm(
            'com_progresstool.update',
            'project',
            array(
                'control' => 'jform',
                'load_data' => $loadData
            )
        );

        if (empty($form))
        {
            $errors = $this->getErrors();
            throw new Exception(implode("\n", $errors), 500);
        }

        return $form;
    }

    /**
     * Retrieve data to be injected into form.
     * This is used for instance when a user encounters a validation error.
     *
     * @return  mixed The data for the form
     * @since   0.5.0
     */
    protected function loadFormData()
    {
        return JFactory::getApplication()->getUserState('com_progresstool.settings.data', array());
    }

    public function deleteProject($projectID)
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        // TODO: project deactivation (not actually deleting the project.)

        $db->setQuery($query)->execute();
    }
}