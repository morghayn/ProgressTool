<?php defined('_JEXEC') or die;

/**
 * Class ProgressToolModelProjectBoard
 *
 * Model for front-end project board functionality.
 *
 * @package ProgressTool
 * @subpackage site
 * @since 0.1.6
 *
 * @author  Morgan Nolan <morgan.nolan@hotmail.com>
 * @link    https://github.com/morghayn
 */
class ProgressToolModelProjectBoard extends JModelItem
{
    /**
     * Retrieves a project by ID.
     *
     * @param int $projectID ID of the project.
     * @return object project object.
     */
    public function getProject($projectID)
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        $columns = array('id', 'name', 'description', 'activated');

        $query
            ->select($db->quoteName($columns))
            ->from($db->quoteName('#__pt_project'))
            ->where($db->quoteName('id') . ' = ' . $db->quote($projectID))
            ->order('id ASC');

        return $db->setQuery($query)->loadObject();
    }

    /**
     * Retrieves all projects belonging to a user.
     *
     * @param int $userID ID of the user.
     * @return mixed object list of all projects belonging to the user.
     * @since 0.1.6
     */
    public function getProjects($userID)
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        $columns = array('id', 'name', 'description', 'activated');

        $query
            ->select($db->quoteName($columns))
            ->from($db->quoteName('#__pt_project'))
            ->where($db->quoteName('user_id') . ' = ' . $db->quote($userID));
        // TODO: $query->order('ordering ASC');

        return $db->setQuery($query)->loadObjectList();
    }

    /**
     * Retrieves approval questions.
     *
     * @return mixed object list of all approval questions.
     * @since 0.2.6
     */
    public function getApprovalQuestions()
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        $columns = array('id', 'question');

        $query
            ->select($db->quoteName($columns))
            ->from($db->quoteName('#__pt_approval_question'));

        return $db->setQuery($query)->loadObjectList();
    }

    /**
     * Processes approval selections. Inserts selection if selection does not exist, else removes selection.
     *
     * @param int $projectID ID of the project.
     * @param int $approvalID ID of the approval question.
     * @since 0.3.0
     */
    public function processSelection($projectID, $approvalID)
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $delete = $db->getQuery(true);
        $insert = $db->getQuery(true);

        $conditions = array(
            $db->quoteName('project_id') . ' = ' . $db->quote($projectID),
            $db->quoteName('approval_id') . ' = ' . $db->quote($approvalID)
        );

        $query
            ->select('COUNT(*)')
            ->from($db->quoteName('#__pt_project_approval'))
            ->where($conditions)
            ->setLimit(1);

        // If selection exists, delete it.
        if ($db->setQuery($query)->loadResult())
        {
            $delete
                ->delete($db->quoteName('#__pt_project_approval'))
                ->where($conditions);

            $db->setQuery($delete)->execute();
        }

        // If selection does not exist, insert it.
        else
        {
            $columns = array('project_id', 'approval_id');
            $values = array($projectID, $approvalID);

            $insert
                ->insert($db->quoteName('#__pt_project_approval'))
                ->columns($db->quoteName($columns))
                ->values(implode(',', $values));

            $db->setQuery($insert)->execute();
        }
    }

    /**
     * Checks if project meets approval criteria.
     *
     * @param int $projectID ID of the project.
     * @return boolean returns true if project meets criteria, else returns false.
     */
    public function isProjectApproved($projectID)
    {
        $db = JFactory::getDbo();
        $countQuestions = $db->getQuery(true);
        $countSelections = $db->getQuery(true);

        $countQuestions
            ->select('COUNT(*)')
            ->from($db->quoteName('#__pt_approval_question'));

        $countSelections
            ->select('COUNT(*)')
            ->from($db->quoteName('#__pt_project_approval'))
            ->where($db->quoteName('project_id') . ' = ' . $db->quote($projectID));

        $numberOfQuestions = $db->setQuery($countQuestions)->loadResult();
        $numberOfSelections = $db->setQuery($countSelections)->loadResult();

        return ($numberOfQuestions == $numberOfSelections);
    }

    /**
     * Activates a project.
     *
     * @param int $projectID ID of the project.
     * @return boolean returns true if project activation is successful, else returns false.
     * @since 0.3.0
     */
    public function activateProject($projectID)
    {
        $db = JFactory::getDbo();
        $update = $db->getQuery(true);
        $delete = $db->getQuery(true);

        $delete
            ->delete($db->quoteName('#__pt_project_approval'))
            ->where($db->quoteName('project_id') . ' = ' . $projectID);

        if ($db->setQuery($delete)->execute())
        {
            $update
                ->update($db->quoteName('#__pt_project'))
                ->set($db->quoteName('activated') . ' = 1')
                ->where($db->quoteName('id') . ' = ' . $db->quote($projectID));

            // If activation is a success, return true.
            return $db->setQuery($update)->execute();
        }

        // If activation fails, return false.
        return false;
    }

    /**
     * Deletes a project. Deletion is setup to cascade so do not worry about referential integrity.
     *
     * @param int $projectID the ID of the project.
     * @since 0.3.0
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

    /**
     * Updates the information of a project.
     *
     * @param int $projectID ID of the project.
     * @param string $name updated name.
     * @param string $description updated description.
     * @return bool status of whether the update was a success or not.
     */
    public function updateProject($projectID, $name, $description)
    {
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

    public function getApprovalSelects($user_id)
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        $columns = array('A.project_id', 'A.approval_id');
        $conditions = array(
            $db->quoteName('P.user_id') . ' = ' . $db->quote($user_id),
            $db->quoteName('P.activated') . ' = 0'
        );

        $query
            ->select($db->quoteName($columns))
            ->from($db->quoteName('#__pt_project', 'P'))
            ->innerjoin($db->quoteName('#__pt_project_approval') . ' AS A ON P.id = A.project_id')
            ->where($conditions);

        $rows = $db->setQuery($query)->loadObjectList();
        $grouped = array();

        foreach ($rows as $row)
            $grouped[$row->project_id][$row->approval_id] = 1;

        return $grouped;
    }

}