<?php defined('_JEXEC') or die;

/**
 * Class ProgressToolModelSurvey
 *
 * Model for front-end survey functionality.
 *
 * @package ProgressTool
 * @subpackage site
 * @since 0.1.0
 *
 * @author  Morgan Nolan <morgan.nolan@hotmail.com>
 * @link    https://github.com/morghayn
 * @license GNU General Public License version 2 or later; see LICENSE.txt
 */
class ProgressToolModelSurvey extends JModelItem
{
    /**
     * Retrieve a list of the survey questions.
     *
     * @return mixed list of the survey questions.
     * @since 0.2.6
     */
    public function getSurveyQuestions()
    {
        // Get a db connection and create a new query object.
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        // Columns to be retrieved.
        $columns = array('id', 'question', 'colour');

        // Prepare query to retrieve the survey questions.
        $query
            ->select($db->quoteName($columns))
            ->from($db->quoteName('#__question'));

        // Set query, and return questions as a list of stdClass objects.
        return $db->setQuery($query)->loadObjectList();
    }

    /**
     * Retrieve choices grouped by their respective questions.
     *
     * @return array the choices grouped by question.
     * @since 0.1.0
     *
     * TODO: I believe this function may break when questions get removed and added (when they get unordered indexes)
     */
    public function getChoices()
    {
        // Get a db connection and create a new query object.
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        // Columns to be retrieved.
        $columns = array('id', 'question_id', 'choice', 'weight');

        // Prepare query to retrieve the choices for the survey questions.
        $query
            ->select($db->quoteName($columns))
            ->from($db->quoteName('#__question_choice'));

        // Set query, and returns choices as an array indexed by their respective questions.
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
            $groupedChoices[$row->question_id][] = $row;
        }

        return $groupedChoices;
    }

    /**
     * Retrieve the name for the project of the projectID specified.
     *
     * @param int $projectID the projectID specifying which project to retrieve a name for.
     * @return mixed the name of the requested project.
     * @since 0.2.6
     *
     * TODO: Merge with getSelections() via a join query.
     */
    public function getProjectName($projectID)
    {
        // Get a db connection and create a new query object.
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        // Select all records from #__question
        $query
            ->select($db->quoteName('name'))
            ->from($db->quoteName('#__project'))
            ->where($db->quoteName('id') . ' = ' . $db->quote($projectID));

        // Reset the query using our newly populated query object.... returning weight
        return $db->setQuery($query)->loadResult();
    }

    /**
     * Returns a list of all the selections made by project specified.
     *
     * @param int $projectID the projectID of the project.
     * @return mixed a list of all selections made by the project specified.
     * @since 0.2.6
     */
    public function getSelections($projectID)
    {
        // Get a db connection and create a new query object.
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        // Prepare query to retrieve the selections made by the specified project.
        $query
            ->select($db->quoteName(array('choice_id')))
            ->from($db->quoteName('#__project_question_choice'))
            ->where($db->quoteName('project_id') . ' = ' . $db->quote($projectID));

        // Set query, and return a list of all choice selection made
        return $db->setQuery($query)->loadColumn();
    }

    /**
     * Returns the questionID of the question which the choice specified belongs to.
     *
     * @param int $choiceID the choiceID of which questionID we want returned.
     * @return mixed the questionID which is in ownership of the choiceID specified.
     * @since 0.1.7
     */
    public function getQuestionID($choiceID)
    {
        // Get a db connection and create a new query object.
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        // Prepare query to retrieve questionID of which owns the choiceID specified.
        $query
            ->select($db->quoteName('question_id'))
            ->from($db->quoteName('#__question_choice'))
            ->where($db->quoteName('id') . ' = ' . $db->quote($choiceID));

        // Set query, and return the questionID.
        return $db->setQuery($query)->loadResult();
    }

    /**
     * Returns the weight value for a choiceID specified.
     *
     * @param int $choiceID the choiceID of which to return a weight value for.
     * @return mixed the weight of the choiceID specified.
     * @since 0.1.7
     */
    public function getWeight($choiceID)
    {
        // Get a db connection and create a new query object.
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        // Prepare query to select the weight of the choiceID specified.
        $query
            ->select($db->quoteName('weight'))
            ->from($db->quoteName('#__question_choice'))
            ->where($db->quoteName('id') . ' = ' . $db->quote($choiceID));

        // Set query, and return the weight of the choiceID specified.
        return $db->setQuery($query)->loadResult();
    }

    /**
     * Inserts a specified choice selection for a specified project.
     *
     * @param int $projectID the projectID which the selection will be made under.
     * @param int $choiceID the choiceID of the selection to be inserted.
     */
    public function select($projectID, $choiceID)
    {
        // Get a db connection and create a new query object.
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        // Columns to insert into.
        $columns = array('project_id', 'choice_id');

        // Values to be inserted.
        $values = array($projectID, $choiceID);

        // Prepare the insert query for the selection to be made.
        $query
            ->insert($db->quoteName('#__project_question_choice'))
            ->columns($db->quoteName($columns))
            ->values(implode(',', $values));

        // Set query and insert selection.
        $db->setQuery($query)->execute();
    }

    /**
     * Deselects the choice of a project specified.
     *
     * @param int $projectID the projectID of which we are deselecting a choice.
     * @param int $choiceID the choiceID that we want deselected.
     * @since 0.2.0
     */
    public function deselect($projectID, $choiceID)
    {
        // Get a db connection and create a new query object.
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        // Conditions specifying which record we want deselected.
        $conditions = array(
            $db->quoteName('project_id') . ' = ' . $projectID,
            $db->quoteName('choice_id') . ' = ' . $choiceID
        );

        // Preparing query which will remove the selection from the selection table.
        $query
            ->delete($db->quoteName('#__project_question_choice'))
            ->where($conditions);

        // Set query, and remove selection from the selection table.
        $db->setQuery($query)->execute();
    }

    /**
     * Checks whether or not a choiceID is currently selected by a specified project.
     *
     * @param int $projectID the projectID of which this concerns.
     * @param int $choiceID the selection of which this concerns.
     * @return mixed a boolean which indicates whether a choice is selected.
     */
    public function isSelected($projectID, $choiceID)
    {
        // Get a db connection and create a new query object.
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        // Prepare query to check whether the project specified has made the selection specified.
        $query
            ->select('COUNT(*)')
            ->from($db->quoteName('#__project_question_choice'))
            ->where($db->quoteName('project_id') . ' = ' . $db->quote($projectID))
            ->where($db->quoteName('choice_id') . ' = ' . $db->quote($choiceID));
        // TODO: Apparently implementing LIMIT 1 method is faster than using COUNT(*)

        // Set query, and return boolean as to whether selection has been made.
        return $db->setQuery($query)->loadResult();
    }
}