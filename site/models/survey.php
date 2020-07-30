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
        //var_dump($grouped_by_question_id);

        return $grouped_by_question_id;
    }
}