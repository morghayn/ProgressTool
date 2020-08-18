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
    public function getUserProjects($userID)
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
     *
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
     * Inserts a specified approvalID selection for a specified project.
     *
     * @param int $projectID the projectID which the selection will be made under.
     * @param int $approvalID the approvalID of the selection to be inserted.
     * @since 0.2.6
     */
    public
    function select($projectID, $approvalID)
    {
        // Get a db connection and create a new query object.
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        // Columns to insert into.
        $columns = array('project_id', 'approval_id');

        // Values to be inserted.
        $values = array($projectID, $approvalID);

        // Prepare the insert query for the selection to be made.
        $query
            ->insert($db->quoteName('#__pt_project_approval'))
            ->columns($db->quoteName($columns))
            ->values(implode(',', $values));

        // Set query and insert selection.
        $db->setQuery($query)->execute();
    }

    /**
     * Deselects a specified approval selection for a specified project.
     *
     * @param int $projectID the approvalID of which we are deselecting a choice.
     * @param int $approvalID the approvalID that we want deselected.
     * @since 0.2.6
     */
    public
    function deselect($projectID, $approvalID)
    {
        // Get a db connection and create a new query object.
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        // Conditions specifying which record we want deselected.
        $conditions = array(
            $db->quoteName('project_id') . ' = ' . $projectID,
            $db->quoteName('approval_id') . ' = ' . $approvalID
        );

        // Preparing query which will remove the selection from the selection table.
        $query
            ->delete($db->quoteName('#__pt_project_approval'))
            ->where($conditions);

        // Set query, and remove selection from the selection table.
        $db->setQuery($query)->execute();
    }

    /**
     * Checks whether or not a approvalID is currently selected by a specified project.
     *
     * @param int $projectID the projectID of which this concerns.
     * @param int $approvalID the selection of which this concerns.
     * @return mixed a boolean which indicates whether a choice is selected.
     * @since 0.2.6
     */
    public
    function isSelected($projectID, $approvalID)
    {
        // Get a db connection and create a new query object.
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        // Prepare query to check whether the project specified has made the selection specified.
        $query
            ->select('COUNT(*)')
            ->from($db->quoteName('#__pt_project_approval'))
            ->where($db->quoteName('project_id') . ' = ' . $db->quote($projectID))
            ->where($db->quoteName('approval_id') . ' = ' . $db->quote($approvalID));
        // TODO: Seperate conditions here
        // TODO: Apparently implementing LIMIT 1 method is faster than using COUNT(*)

        // Set query, and return boolean as to whether selection has been made.
        return $db->setQuery($query)->loadResult();
    }

    /**
     * TODO: Documentation here
     * @since 0.2.6
     */
    public
    function isProjectValid($goal, $projectID)
    {
        // Get a db connection and create a new query object.
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        // Prepare query to check whether the project specified has made the selection specified.
        $query
            ->select('COUNT(*)')
            ->from($db->quoteName('#__pt_project_approval'))
            ->where($db->quoteName('project_id') . ' = ' . $db->quote($projectID));
        // TODO: Apparently implementing LIMIT 1 method is faster than using COUNT(*)

        // Set query, and return boolean as to whether selection has been made.
        $currentGoal = $db->setQuery($query)->loadResult();
        return $currentGoal == $goal;
    }

    /**
     * TODO: Documentation here
     * @since 0.2.6
     */
    public
    function activateProject($projectID)
    {
        // Get a db connection and create a new query object.
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        $query
            ->update($db->quoteName('#__pt_project'))
            ->set($db->quoteName('activated') . ' = 1')
            ->where($db->quoteName('id') . ' = ' . $db->quote($projectID));

        $db->setQuery($query);

        $result = $db->execute();
    }

}