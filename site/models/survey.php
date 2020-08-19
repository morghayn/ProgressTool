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
     * @since 0.3.0
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

    public function getQuestionScoreQuery($db)
    {
        // Create a new query object.
        $scores = $db->getQuery(true);

        // Prepare query to calculate and retrieve question scores.
        $scores
            ->select($db->quoteName('question_id'))
            ->select('SUM(weight) as total')
            ->from($db->quoteName('#__pt_question_choice'))
            ->group($db->quoteName('question_id'));

        // Return question score query.
        return $scores;
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
        $questionScores = $this->getQuestionScoreQuery($db);

        // Columns to be retrieved.
        $columns = array('Q.id', 'Q.question', 'C.colour_hex', 'C.colour_rgb', 'T.total');

        $questions
            ->select($db->quoteName($columns))
            ->from($db->quoteName('#__pt_question', 'Q'))
            ->innerjoin('(' . $included . ') AS QC ON ' . $db->quoteName('Q.id') . ' = ' . $db->quoteName('QC.question_id'))
            ->innerjoin($db->quoteName('#__pt_category') . ' AS C ON ' . $db->quoteName('Q.category_id') . ' = ' . $db->quoteName('C.id'))
            ->innerjoin('(' . $questionScores . ') AS T ON ' . $db->quoteName('Q.id') . ' = ' . $db->quoteName('T.question_id'))
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
     * Returns data attached to a specific choice.
     *
     * @param int $choiceID the choiceID of the choice in question.
     * @return mixed an associative array containing data of the choice in question.
     * @since 0.3.0
     */
    public function getChoice($choiceID)
    {
        // Get a db connection and create a new query object.
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        // Prepare query to associative array for the choice in question.
        $query
            ->select($db->quoteName('*'))
            ->from($db->quoteName('#__pt_question_choice'))
            ->where($db->quoteName('id') . ' = ' . $db->quote($choiceID));

        // Set query, and return the questionID.
        return $db->setQuery($query)->loadAssoc();
    }

    /**
     * TODO: Documentation here
     *
     * @since 0.3.0
     */
    public function processSelection($projectID, $choiceID)
    {
        // Get a db connection and create a new query object.
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        // Conditions specifying which record we want deselected.
        $conditions = array(
            $db->quoteName('project_id') . ' = ' . $projectID,
            $db->quoteName('choice_id') . ' = ' . $choiceID
        );

        // Prepare query to check whether the project specified has made the selection specified.
        $query
            ->select('COUNT(*)')
            ->from($db->quoteName('#__pt_project_choice'))
            ->where($conditions)
            ->setLimit(1);

        // If selection exists, delete it.
        if ($db->setQuery($query)->loadResult())
        {
            // Prepare query object.
            $query = $db->getQuery(true);

            // Preparing query which will remove the selection from the selection table.
            $query
                ->delete($db->quoteName('#__pt_project_choice'))
                ->where($conditions);

            // Set query, and remove selection from the selection table.
            $db->setQuery($query)->execute();
            return false;
        }
        // If selection does not exist, insert it.
        else
        {
            // Prepare query object.
            $query = $db->getQuery(true);

            // Columns to be inserted into and values to be inserted.
            $columns = array('project_id', 'choice_id');
            $values = array($projectID, $choiceID);

            // Prepare the insert query for the selection to be made.
            $query
                ->insert($db->quoteName('#__pt_project_choice'))
                ->columns($db->quoteName($columns))
                ->values(implode(',', $values));

            // Set query and insert selection.
            $db->setQuery($query)->execute();
            return true;
        }
    }

    public function getQuestionScore($projectID, $questionID)
    {
        $db = JFactory::getDbo();
        $getChoices = $db->getQuery(true);
        $getQuestionScore = $db->getQuery(true);

        $getChoices
            ->select($db->quoteName('id'))
            ->select($db->quoteName('weight'))
            ->from($db->quoteName('#__pt_question_choice'))
            ->where($db->quoteName('question_id') . ' = (' . $questionID . ')');

        $getQuestionScore
            ->select('SUM(weight) AS score')
            ->from('#__pt_project_choice')
            ->innerJoin('('.$getChoices.') AS CHOICES ON choice_id = id')
            ->where($db->quoteName('project_id') . ' = ' . $db->quote($projectID));
            //->setLimit(1);

        $score = $db->setQuery($getQuestionScore)->loadResult();
        return is_null($score) ? "0" : $score;
    }

    public function getQuestionID($choiceID)
    {
        $db = JFactory::getDbo();
        $getQuestionID = $db->getQuery(true);

        $getQuestionID
            ->select($db->quoteName('question_id'))
            ->from($db->quoteName('#__pt_question_choice'))
            ->where($db->quoteName('id') . ' = ' . $db->quote($choiceID))
            ->setLimit(1);

        return $db->setQuery($getQuestionID)->loadResult();
    }
}