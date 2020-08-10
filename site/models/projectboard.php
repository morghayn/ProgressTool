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
 * @license GNU General Public License version 2 or later; see LICENSE.txt
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
            ->from($db->quoteName('#__project'))
            ->where($db->quoteName('user_id') . ' = ' . $db->quote($userID));
        // TODO: $query->order('ordering ASC');

        // Set query, execute and return projects as a list of stdClass objects.
        return $db->setQuery($query)->loadObjectList();
    }

    /**
     * Retrieve a list of the preliminary questions.
     *
     * @return mixed list of the preliminary questions.
     * @since 0.2.6
     */
    public function getPreliminaryQuestions()
    {
        // Get a db connection and create a new query object.
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        // Columns to be returned.
        $columns = array('id', 'question');

        // Prepare query to retrieve the preliminary questions.
        $query
            ->select($db->quoteName($columns)) // TODO: does this have to be an array?
            ->from($db->quoteName('#__preliminary_question'));

        // Set query, and return questions as a list of stdClass objects.
        return $db->setQuery($query)->loadObjectList();
    }

    /**
     * Inserts a specified preliminaryID selection for a specified project.
     *
     * @param int $projectID the projectID which the selection will be made under.
     * @param int $preliminaryID the preliminaryID of the selection to be inserted.
     * @since 0.2.6
     */
    public function select($projectID, $preliminaryID)
    {
        // Get a db connection and create a new query object.
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        // Columns to insert into.
        $columns = array('project_id', 'preliminary_id');

        // Values to be inserted.
        $values = array($projectID, $preliminaryID);

        // Prepare the insert query for the selection to be made.
        $query
            ->insert($db->quoteName('#__project_preliminary'))
            ->columns($db->quoteName($columns))
            ->values(implode(',', $values));

        // Set query and insert selection.
        $db->setQuery($query)->execute();
    }

    /**
     * Deselects a specified preliminary selection for a specified project.
     *
     * @param int $projectID the preliminaryID of which we are deselecting a choice.
     * @param int $preliminaryID the preliminaryID that we want deselected.
     * @since 0.2.6
     */
    public function deselect($projectID, $preliminaryID)
    {
        // Get a db connection and create a new query object.
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        // Conditions specifying which record we want deselected.
        $conditions = array(
            $db->quoteName('project_id') . ' = ' . $projectID,
            $db->quoteName('preliminary_id') . ' = ' . $preliminaryID
        );

        // Preparing query which will remove the selection from the selection table.
        $query
            ->delete($db->quoteName('#__project_preliminary'))
            ->where($conditions);

        // Set query, and remove selection from the selection table.
        $db->setQuery($query)->execute();
    }

    /**
     * Checks whether or not a preliminaryID is currently selected by a specified project.
     *
     * @param int $projectID the projectID of which this concerns.
     * @param int $preliminaryID the selection of which this concerns.
     * @return mixed a boolean which indicates whether a choice is selected.
     * @since 0.2.6
     */
    public function isSelected($projectID, $preliminaryID)
    {
        // Get a db connection and create a new query object.
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        // Prepare query to check whether the project specified has made the selection specified.
        $query
            ->select('COUNT(*)')
            ->from($db->quoteName('#__project_preliminary'))
            ->where($db->quoteName('project_id') . ' = ' . $db->quote($projectID))
            ->where($db->quoteName('preliminary_id') . ' = ' . $db->quote($preliminaryID));
        // TODO: Seperate conditions here
        // TODO: Apparently implementing LIMIT 1 method is faster than using COUNT(*)

        // Set query, and return boolean as to whether selection has been made.
        return $db->setQuery($query)->loadResult();
    }

    /**
     * TODO: Documentation here
     * @since 0.2.6
     */
    public function isProjectValid($goal, $projectID)
    {
        // Get a db connection and create a new query object.
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        // Prepare query to check whether the project specified has made the selection specified.
        $query
            ->select('COUNT(*)')
            ->from($db->quoteName('#__project_preliminary'))
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
    public function activateProject($projectID)
    {
        // Get a db connection and create a new query object.
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        $query
            ->update($db->quoteName('#__project'))
            ->set($db->quoteName('activated') . ' = 1')
            ->where($db->quoteName('id') . ' = ' . $db->quote($projectID));

        $db->setQuery($query);

        $result = $db->execute();
    }

}