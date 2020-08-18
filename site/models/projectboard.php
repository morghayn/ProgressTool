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
     * Retrieve a list of a user's projects.
     *
     * @param int $userID the user id of which the project belongs.
     * @return mixed a list of the user's projects
     * @since 0.1.6
     */
    public function getProjects($userID)
    {
        // Get a db connection and create a new query object.
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        // Columns to be retrieved.
        $columns = array('id', 'name', 'description', 'activated');

        // Preparing query to retrieve a user's projects.
        $query
            ->select($db->quoteName($columns))
            ->from($db->quoteName('#__pt_project'))
            ->where($db->quoteName('user_id') . ' = ' . $db->quote($userID));
        // TODO: $query->order('ordering ASC');

        // Set query, execute and return projects as a list of stdClass objects.
        return $db->setQuery($query)->loadObjectList();
    }

    /**
     * Returns a project object linked to the projectID passed through parameters.
     *
     * @param int $projectID the ID of the project.
     * @return mixed the questions project object.
     */
    public function getProject($projectID)
    {
        // Get a db connection and create a new query object.
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        // Columns to be retrieved.
        $columns = array('id', 'name', 'description', 'activated');

        // Preparing query to retrieve a user's project.
        $query
            ->select($db->quoteName($columns))
            ->from($db->quoteName('#__pt_project'))
            ->where($db->quoteName('id') . ' = ' . $db->quote($projectID));
        // TODO: $query->order('ordering ASC');

        // Set query, execute and return project object.
        return $db->setQuery($query)->loadObject();
    }

    /**
     * Retrieve a list of the approval questions.
     *
     * @return mixed list of the approval questions.
     * @since 0.2.6
     */
    public function getApprovalQuestions()
    {
        // Get a db connection and create a new query object.
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        // Columns to be returned.
        $columns = array('id', 'question');

        // Prepare query to retrieve the approval questions.
        $query
            ->select($db->quoteName($columns)) // TODO: does this have to be an array?
            ->from($db->quoteName('#__pt_approval_question'));

        // Set query, and return questions as a list of stdClass objects.
        return $db->setQuery($query)->loadObjectList();
    }

    /**
     * Takes in choices through parameters and returns an array of the choices grouped by question.
     *
     * @param mixed $rows the choice rows which are to be grouped.
     * @return array the choices grouped by question.
     * @since 0.2.6
     */
    public function groupChoices($rows)
    {
        $groupedChoices = array();

        foreach ($rows as $row)
        {
            // Grouping by questionID.
            $groupedChoices[$row->project_id][] = $row;
        }

        return $groupedChoices;
    }

    /**
     * Processes approval selections. Inserts selections if selection does not exist, else removes selection.
     *
     * @param int $projectID the ID of the project.
     * @param int $approvalID the ID of the approval question.
     * @since 0.3.0
     */
    public function processSelection($projectID, $approvalID)
    {
        // Get a db connection and create a new query object.
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        // Conditions to find a specific selection.
        $conditions = array(
            $db->quoteName('project_id') . ' = ' . $db->quote($projectID),
            $db->quoteName('approval_id') . ' = ' . $db->quote($approvalID)
        );

        // Prepare query to check whether selection already exists
        $query
            ->select('COUNT(*)')
            ->from($db->quoteName('#__pt_project_approval'))
            ->where($conditions)
            ->setLimit(1);

        // If selection exists, delete it.
        if ($db->setQuery($query)->loadResult())
        {
            // Prepare query object.
            $query = $db->getQuery(true);

            // Prepare the delete query for the selection.
            $query
                ->delete($db->quoteName('#__pt_project_approval'))
                ->where($conditions);

            // Set query and remove selection.
            $db->setQuery($query)->execute();
        }
        // If selection does not exist, insert it.
        else
        {
            // Prepare query object.
            $query = $db->getQuery(true);

            // Columns to be inserted into and values to be inserted.
            $columns = array('project_id', 'approval_id');
            $values = array($projectID, $approvalID);

            // Prepare the insert query for the selection to be made.
            $query
                ->insert($db->quoteName('#__pt_project_approval'))
                ->columns($db->quoteName($columns))
                ->values(implode(',', $values));

            // Set query and insert selection.
            $db->setQuery($query)->execute();
        }
    }

    /**
     * Checks if the project activation criteria has been met. If criteria met, project is activated, else it is not. Where the criteria is having
     * the same number of approval selections as there are approval questions.
     *
     * @param int $projectID the ID of the project.
     * @return boolean returns true if project has been activated, else returns false.
     * @since 0.3.0
     */
    public function activateProject($projectID)
    {
        // Get a db connection and create a new query object.
        $db = JFactory::getDbo();

        // Setting up query objects.
        $criteria = $db->getQuery(true);
        $selectionCount = $db->getQuery(true);
        $insert = $db->getQuery(true);
        $delete = $db->getQuery(true);

        // Prepares query to count the number of approval questions.
        $criteria
            ->select('COUNT(*)')
            ->from($db->quoteName('#__pt_approval_question'));

        // Prepares query to count the number of approval selections a project has made.
        $selectionCount
            ->select('COUNT(*)')
            ->from($db->quoteName('#__pt_project_approval'))
            ->where($db->quoteName('project_id') . ' = ' . $db->quote($projectID));

        if ($db->setQuery($selectionCount)->loadResult() == $db->setQuery($criteria)->loadResult())
        {
            // Prepares query to delete the approval selections made by the project.
            $delete->delete($db->quoteName('#__pt_project_approval'))
                ->where($db->quoteName('project_id') . ' = ' . $projectID);

            // Executes deletion query, if success, project will be activated.
            if ($db->setQuery($delete)->execute())
            {
                $insert
                    ->update($db->quoteName('#__pt_project'))
                    ->set($db->quoteName('activated') . ' = 1')
                    ->where($db->quoteName('id') . ' = ' . $db->quote($projectID));

                // If insertion is a success, return true.
                return $db->setQuery($insert)->execute();
            }
        }
        else
        {
            return false;
        }
    }

    /**
     * Deletes a project. Deletion is setup to cascade so do not worry about referential integrity.
     *
     * @param int $projectID the ID of the project.
     * @since 0.3.0
     */
    public function deleteProject($projectID)
    {
        // Get a db connection and create a new query object.
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        // Prepares query to delete project.
        $query->delete($db->quoteName('#__project'))
            ->where($db->quoteName('project_id') . ' = ' . $projectID);

        // Sets query, executes and stores result.
        $result = $db->setQuery($query)->execute();
    }

    /**
     * // TODO: Documentation here :: WIP functionality
     */
    public function getApprovalSelections($user_id)
    {
        // Get a db connection and create a new query object.
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        $columns = array('PRAP.project_id', 'PRAP.approval_id');

        $query
            ->select($db->quoteName($columns)) // TODO: does this have to be an array?
            ->from($db->quoteName('#__pt_project', 'PR'))
            ->innerjoin($db->quoteName('#__pt_project_approval') . ' AS PRAP ON PR.id = PRAP.project_id')
            ->where($db->quoteName('PR.user_id') . ' = ' . $user_id);

        return $this->groupChoices($db->setQuery($query)->loadObjectList());
    }
}