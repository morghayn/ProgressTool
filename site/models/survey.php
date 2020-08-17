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
     * Returns an index to a country String passed through, else returns 0 if not found.
     *
     * @param string $country the country name.
     * @return int the country index.
     * @since 0.3.0
     */
    public function getCountryIndex($country)
    {
        // Get a db connection and create a new query object.
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        // Prepare query to retrieve the country id.
        $query
            ->select($db->quoteName('C.id'))
            ->from($db->quoteName('#__pt_country', 'C'))
            ->where($db->quoteName('C.country') . ' LIKE ' . $db->quote($country));

        // Set query, and returns countryIndex.
        $countryIndex = $db->setQuery($query)->loadResult();
        return is_null($countryIndex) ? 0 : $countryIndex;
    }

    /**
     * Returns a query object to retrieve question pool for a specified country, a question pool for a country is algorithmically defined as:
     * (Universal Question Pool u The Question Pool of the Country Specified) /
     * (The Questions Excluded from the Universal Question Pool of the Country Specified)
     *
     * Where / = Relative Complement and u = Union
     *
     * @param object $db the current database connection.
     * @param int $country index for country specified.
     * @return mixed the query object used to retrieve question pool for a specified country.
     */
    public function getQuestionPoolQuery($db, $country)
    {
        $excluded = $db->getQuery(true);
        $included = $db->getQuery(true);

        // Index for universal question pool.
        $universal = 1;

        // Query to retrieve universal questions excluded from a specific country.
        $excluded
            ->select($db->quoteName('Exclude.question_id'))
            ->from($db->quoteName('#__pt_exclude', 'Exclude'))
            ->where($db->quoteName('Exclude.country_id') . ' = ' . $country);

        // Query used to
        $included
            ->select($db->quoteName('QC.question_id'))
            ->from($db->quoteName('#__pt_question_country', 'QC'))
            ->where(
                '( ' . $db->quoteName('QC.country_id') . ' = ' . $universal . ' OR ' . $db->quoteName('QC.country_id') . ' = ' . $country . ')' .
                ' AND' . $db->quoteName('QC.question_id') . ' NOT IN (' . $excluded . ')'
            );

        return $included;
    }

    /**
     * Retrieve a list of universal and location specific questions.
     *
     * @param $country int country index used to get location specific questions.
     * @return mixed objectList containing the location specific questions.
     * @since 0.3.0
     */
    public function getQuestions($country)
    {
        // Get a db connection and create a new query object.
        $db = JFactory::getDbo();
        $questions = $db->getQuery(true);
        $included = $this->getQuestionPoolQuery($db, $country);

        // Columns to be retrieved.
        $columns = array('Q.id', 'Q.question', 'C.colour_hex', 'C.colour_rgb');

        $questions
            ->select($db->quoteName($columns))
            ->from($db->quoteName('#__pt_question', 'Q'))
            ->innerjoin('(' . $included . ') AS QC ON ' . $db->quoteName('Q.id') . ' = ' . $db->quoteName('QC.question_id'))
            ->innerjoin($db->quoteName('#__pt_category') . ' AS C ON ' . $db->quoteName('Q.category_id') . ' = ' . $db->quoteName('C.id'))
            ->order('Q.id ASC');

        // Set query, and return questions as a list of stdClass objects.
        return $db->setQuery($questions)->loadObjectList();
    }

    /**
     * Retrieve a list of universal and location specific choices grouped by their respective question.
     * Additionally, to indicate whether a project has selected a choice, the project_id attribute has been included from the left join.
     * The project_id specified in the parameters will be returned to indicate a selection has been made,
     * else if no such selection has been made, the field will be null to indicate no selection has been made.
     *
     * @param int $projectID project index for which selections will be retrieved
     * @param int $country country index used to get location specific choices.
     * @return array the choices grouped by their respective questions, with an attribute to indicate whether it has been selected or not.
     * @since 0.1.0
     */
    public function getChoices($projectID, $country)
    {
        // Get a db connection and create a new query object.
        $db = JFactory::getDbo();
        $choices = $db->getQuery(true);
        $included = $this->getQuestionPoolQuery($db, $country);

        // Columns to be retrieved.
        $columns = array('Choice.id', 'Choice.question_id', 'Choice.choice', 'Choice.weight', 'Selected.project_id');

        // Prepare query to retrieve the choices for the survey questions.
        $choices
            ->select($db->quoteName($columns))
            ->from($db->quoteName('#__pt_question_choice', 'Choice'))
            ->innerjoin('(' . $included . ') AS Pool ON ' . $db->quoteName('Choice.question_id') . ' = ' . $db->quoteName('Pool.question_id'))
            ->leftjoin(
                $db->quoteName('#__pt_project_choice') .
                ' AS Selected ON ' . $db->quoteName('Choice.id') . ' = ' . $db->quoteName('Selected.choice_id') .
                ' AND ' . $db->quoteName('Selected.project_id') . ' = ' . $projectID
            );

        /** TODO: remove when testing is done.
         * ini_set("xdebug.var_display_max_children", '-1');
         * ini_set("xdebug.var_display_max_data", '-1');
         * ini_set("xdebug.var_display_max_depth", '-1');
         * var_dump($db->replacePrefix((string) $choices));
         */

        // Set query, and returns choices as an array indexed by their respective questions.
        return $this->groupChoices($db->setQuery($choices)->loadObjectList());
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
     * Returns associated array containing data pertaining to the project specified in the parameters.
     *
     * @param int $projectID the ID used to identify project.
     * @return mixed associated array of dataa.
     * @since 0.3.0
     */
    public function getProject($projectID)
    {
        // Get a db connection and create a new query object.
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        // Columns to be retrieved.
        $columns = array('user_id', 'name', 'activated');

        // Select all records from #__pt_question
        $query
            ->select($db->quoteName($columns))
            ->from($db->quoteName('#__pt_project'))
            ->where($db->quoteName('id') . ' = ' . $db->quote($projectID));

        // Reset the query using our newly populated query object.... returning weight
        return $db->setQuery($query)->loadAssoc();
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
            ->from($db->quoteName('#__pt_question_choice'))
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
            ->from($db->quoteName('#__pt_question_choice'))
            ->where($db->quoteName('id') . ' = ' . $db->quote($choiceID));

        // Set query, and return the weight of the choiceID specified.
        return $db->setQuery($query)->loadResult();
    }

    /**
     * Inserts a specified choice selection for a specified project.
     *
     * @param int $projectID the projectID which the selection will be made under.
     * @param int $choiceID the choiceID of the selection to be inserted.
     * @since 0.2.6
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
            ->insert($db->quoteName('#__pt_project_choice'))
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
            ->delete($db->quoteName('#__pt_project_choice'))
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
     * @since 0.2.6
     */
    public function isSelected($projectID, $choiceID)
    {
        // Get a db connection and create a new query object.
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        // Prepare query to check whether the project specified has made the selection specified.
        $query
            ->select('COUNT(*)')
            ->from($db->quoteName('#__pt_project_choice'))
            ->where($db->quoteName('project_id') . ' = ' . $db->quote($projectID))
            ->where($db->quoteName('choice_id') . ' = ' . $db->quote($choiceID));
        // TODO: Apparently implementing LIMIT 1 method is faster than using COUNT(*)

        // Set query, and return boolean as to whether selection has been made.
        return $db->setQuery($query)->loadResult();
    }
}