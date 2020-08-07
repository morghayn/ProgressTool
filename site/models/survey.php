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
     * Retrieve survey questions.
     *
     * @return mixed survey questions.
     * @since 0.1.0
     */
    public function getQuestions()
    {
        // Get a db connection.
        $db = JFactory::getDbo();

        // Create a new query object.
        $query = $db->getQuery(true);

        // Select all records from #__question
        $query->select($db->quoteName(array('id', 'question', 'primary', 'secondary')));
        $query->from($db->quoteName('#__question'));

        // Reset the query using our newly populated query object.
        $db->setQuery($query);

        // Load the results as a list of stdClass objects (see later for more options on retrieving data).
        return $db->loadObjectList();
    }

    /**
     * Retrieve choices grouped by individual question.
     *
     * @return array question choices grouped by individual question.
     * @since 0.1.0
     */
    public function getChoices()
    {
        // Get a db connection.
        $db = JFactory::getDbo();

        // Create a new query object.
        $query = $db->getQuery(true);

        // Select all records from #__question
        $query->select($db->quoteName(array('id', 'question_id', 'choice', 'weight')));
        $query->from($db->quoteName('#__question_choice'));

        // Reset the query using our newly populated query object.
        $db->setQuery($query);

        // Load the results as a list of stdClass objects (see later for more options on retrieving data).
        $grouped_by_question_id = array(); // PLEASE GIVE ME GOOD COMMENT
        foreach ($db->loadObjectList() as $row) {
            $grouped_by_question_id[$row->question_id][] = $row;
        }
        // var_dump($grouped_by_question_id);

        return $grouped_by_question_id;
    }

    /**
     * TODO
     * @since 0.1.7
     */
    public function getQuestionID($choice)
    {
        // Get a db connection.
        $db = JFactory::getDbo();

        // Create a new query object.
        $query = $db->getQuery(true);

        // Select all records from #__question
        $query->select($db->quoteName('question_id'));
        $query->from($db->quoteName('#__question_choice'));
        $query->where($db->quoteName('id') . ' = ' . $db->quote($choice));

        // Reset the query using our newly populated query object.
        $db->setQuery($query);

        // returning weight
        return $db->loadResult();
    }

    /**
     * TODO
     * @since 0.1.7
     */
    public function getWeight($choice)
    {
        // Get a db connection.
        $db = JFactory::getDbo();

        // Create a new query object.
        $query = $db->getQuery(true);

        // Select all records from #__question
        $query->select($db->quoteName('weight'));
        $query->from($db->quoteName('#__question_choice'));
        $query->where($db->quoteName('id') . ' = ' . $db->quote($choice));

        // Reset the query using our newly populated query object.
        $db->setQuery($query);

        // returning weight
        return $db->loadResult();
    }

    /**
     * TODO
     * @since 0.1.7
     */
    public function insertProjectQuestionChoice($projectID, $choiceID)
    {
        // Get a db connection.
        $db = JFactory::getDbo();

        // Create a new query object.
        $query = $db->getQuery(true);

        // Insert columns.
        $columns = array('project_id', 'choice_id');

        // Insert values.
        $values = array($projectID, $choiceID);

        // Prepare the insert query.
        $query
            ->insert($db->quoteName('#__project_question_choice'))
            ->columns($db->quoteName($columns))
            ->values(implode(',', $values));

        // Set the query using our newly populated query object and execute it.
        $db->setQuery($query);
        $db->execute();
    }

    /**
     * TODO
     * @since 0.1.8
     */
    public function getSelected($projectID)
    {
        // Get a db connection.
        $db = JFactory::getDbo();

        // Create a new query object.
        $query = $db->getQuery(true);

        // Select all records from #__question
        $query->select($db->quoteName(array('choice_id')));
        $query->from($db->quoteName('#__project_question_choice'));
        $query->where($db->quoteName('project_id') . ' = ' . $db->quote($projectID));

        // Reset the query using our newly populated query object.
        $db->setQuery($query);

        // PLEASE GIVE ME GOOD COMMENT
        $choiceID = $db->loadColumn();

        /** for debug
         * var_dump($choiceID);
         */

        return $choiceID;
    }

    /**
     * TODO
     * @since 0.1.9
     */
    public function checkSelected($projectID, $choiceID)
    {
        $db = JFactory::getDbo();
        $query = $db
            ->getQuery(true)
            ->select('COUNT(*)')
            ->from($db->quoteName('#__project_question_choice'))
            ->where($db->quoteName('project_id') . ' = ' . $db->quote($projectID))
            ->where($db->quoteName('choice_id') . ' = ' . $db->quote($choiceID));
        // TODO should I try to Limit 1? Apparently it might be faster than using COUNT(*)

        $db->setQuery($query);
        return $db->loadResult();
    }

    /**
     * TODO
     * @since 0.2.0
     */
    public function deselect($projectID, $choiceID)
    {
        $db = JFactory::getDbo();

        $conditions = array(
            $db->quoteName('project_id') . ' = ' . $projectID,
            $db->quoteName('choice_id') . ' = ' . $choiceID
        );

        $query = $db
            ->getQuery(true)
            ->delete($db->quoteName('#__project_question_choice'))
            ->where($conditions);


        $db->setQuery($query);
        $result = $db->execute();
        /**
         * $db = JFactory::getDbo();
         *
         * $query = $db->getQuery(true);
         *
         * // delete all custom keys for user 1001.
         * $conditions = array(
         * $db->quoteName('user_id') . ' = 1001',
         * $db->quoteName('profile_key') . ' = ' . $db->quote('custom.%')
         * );
         *
         * $query->delete($db->quoteName('#__user_profiles'));
         * $query->where($conditions);
         *
         * $db->setQuery($query);
         *
         * $result = $db->execute();
         */
    }

}