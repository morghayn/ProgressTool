<?php defined('_JEXEC') or die;

/**
 * (Site) Class ProgressToolModelSettings
 *
 * Model for front-end project form functionality.
 *
 * @package ProgressTool
 * @subpackage site
 * @since 0.5.0
 *
 * @author  Morgan Nolan <morgan.nolan@hotmail.com>
 * @link    https://github.com/morghayn
 */
class ProgressToolModelProject extends JModelAdmin
{
    /**
     * Returns associative array containing the project details of the project associated with projectID passed through parameters.
     *
     * @param int $projectID
     * @return array
     * @since 0.3.0
     */
    public function getProject($projectID)
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        $columns = array('id', 'name', 'description', 'type_id', 'group_id');

        $query
            ->select($db->quoteName($columns))
            ->from($db->quoteName('#__pt_project'))
            ->where($db->quoteName('id') . ' = ' . $db->quote($projectID))
            ->setLimit(1);

        $project = $db->setQuery($query)->loadObjectList()[0];
        return array(
            "projectID" => $project->id,
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
     * @return mixed JForm object on success, false on failure
     * @throws Exception
     * @since   0.5.0
     */
    public function getForm($data = array(), $loadData = true)
    {
        $form = $this->loadForm(
            'com_progresstool.project',
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
        return JFactory::getApplication()->getUserState('com_progresstool.project.data', array());
    }

    /**
     * Creates a new project entry using the data provided.
     *
     * @param array $userID
     * @param $name
     * @param $description
     * @param $type
     * @param $groupID
     * @return bool|mixed
     * @since 0.5.0
     */
    public function create($userID, $name, $description, $type, $groupID)
    {
        $db = JFactory::getDbo();
        $insert = $db->getQuery(true);

        $columns = array('user_id', 'group_id', 'name', 'description', 'type_id', 'creation_date');
        $values = array($userID, $db->quote($groupID), $db->quote($name), $db->quote($description), $db->quote($type), 'NOW()');

        $insert
            ->insert($db->quoteName('#__pt_project'))
            ->columns($db->quoteName($columns))
            ->values(implode(',', $values));

        return $db->setQuery($insert)->execute();
    }

    /**
     * Updates the project details using the data provided.
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

    // TODO: Document
    public function getGroupsQuery($userID)
    {
        return (
            'SELECT CG.id, CG.name ' .
            'FROM #__community_groups AS CG ' .
            'INNER JOIN #__community_groups_members AS CGM ON CG.id = CGM.groupid ' .
            'WHERE memberid = ' . $userID . ' AND CGM.permissions = 1 '
        );
    }

    // TODO: Document
    public function deleteProject($projectID)
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        // TODO: project deactivation (not actually deleting the project.)

        $db->setQuery($query)->execute();
    }
}