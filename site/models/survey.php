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
     * Returns an index to a country String passed through, else returns 1 if not found. Country index of 1 represents the universal question pool.
     *
     * @param string $country the country name.
     * @return int the country index.
     * @since 0.3.0
     */
    public function getCountryIndex($country)
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        $query
            ->select($db->quoteName('C.id'))
            ->from($db->quoteName('#__pt_country', 'C'))
            ->where($db->quoteName('C.country') . ' LIKE ' . $db->quote($country));

        $countryIndex = $db->setQuery($query)->loadResult();
        return is_null($countryIndex) ? 1 : $countryIndex;
    }

    /**
     * Retrieve a list of location specific questions.
     *
     * @param $country int country index used to get location specific questions.
     * @return mixed objectList containing the location specific questions.
     * @since 0.3.0
     */
    public function getQuestions($country)
    {
        $db = JFactory::getDbo();
        $getQuestions = $db->getQuery(true);

        $columns = array('Q.id', 'Q.question', 'CA.colour_hex', 'CA.colour_rgb');

        $getQuestions
            ->select($db->quoteName($columns))
            ->select('SUM(CH.weight) as total')
            ->from($db->quoteName('#__pt_question', 'Q'))
            ->innerjoin($db->quoteName('#__pt_question_country', 'CO') . ' ON ' . $db->quoteName('Q.id') . ' = ' . $db->quoteName('CO.question_id'))
            ->innerjoin($db->quoteName('#__pt_question_choice', 'CH') . ' ON ' . $db->quoteName('Q.ID') . ' = ' . $db->quoteName('CH.question_id'))
            ->innerjoin($db->quoteName('#__pt_category', 'CA') . ' ON ' . $db->quoteName('Q.category_id') . ' = ' . $db->quoteName('CA.id'))
            ->where($db->quoteName('CO.country_id') . ' = ' . $db->quote($country))
            ->group($db->quoteName('Q.id'))
            ->order('Q.id ASC');

        return $db->setQuery($getQuestions)->loadObjectList();
    }

    /**
     * Retrieve a list of location specific choices. Additionally, to indicate whether a project has selected a choice, the project_id attribute has
     * is retrieved via a left join. If a selection has been made, the projectID will be present, else the field will return null.
     *
     * @param int $projectID project index for which selections will be retrieved
     * @param int $country country index used to get location specific choices.
     * @return array the choices grouped by their respective questions, with an attribute to indicate whether it has been selected or not.
     * @since 0.1.0
     */
    public function getChoices($projectID, $country)
    {
        $db = JFactory::getDbo();
        $choices = $db->getQuery(true);

        $columns = array('CH.id', 'CH.question_id', 'CH.choice', 'CH.weight', 'S.project_id');
        $leftJoinCondition1 = $db->quoteName('CH.id') . ' = ' . $db->quoteName('S.choice_id');
        $leftJoinCondition2 = $db->quoteName('S.project_id') . ' = ' . $db->quote($projectID);

        $choices
            ->select($db->quoteName($columns))
            ->from($db->quoteName('#__pt_question_choice', 'CH'))
            ->innerjoin($db->quoteName('#__pt_question', 'Q') . ' ON CH.question_id = Q.id')
            ->innerjoin($db->quoteName('#__pt_question_country', 'CO') . ' ON Q.id = CO.question_id')
            ->leftjoin($db->quoteName('#__pt_project_choice', 'S') . ' ON ' . $leftJoinCondition1 . ' AND ' . $leftJoinCondition2)
            ->where($db->quoteName('CO.country_id') . ' = ' . $db->quote($country));

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
     * @return mixed associated array of data.
     * @since 0.3.0
     */
    public function getProject($projectID)
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        $columns = array('user_id', 'name', 'activated');

        $query
            ->select($db->quoteName($columns))
            ->from($db->quoteName('#__pt_project'))
            ->where($db->quoteName('id') . ' = ' . $db->quote($projectID));

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
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        $query
            ->select($db->quoteName('*'))
            ->from($db->quoteName('#__pt_question_choice'))
            ->where($db->quoteName('id') . ' = ' . $db->quote($choiceID));

        return $db->setQuery($query)->loadAssoc();
    }

    /**
     * TODO: Documentation here
     *
     * @param $projectID
     * @param $choiceID
     * @return bool
     * @since 0.3.0
     */
    public function processSelection($projectID, $choiceID)
    {
        $db = JFactory::getDbo();
        $exists = $db->getQuery(true);
        $delete = $db->getQuery(true);
        $insert = $db->getQuery(true);

        $conditions = array(
            $db->quoteName('project_id') . ' = ' . $db->quote($projectID),
            $db->quoteName('choice_id') . ' = ' . $db->quote($choiceID)
        );

        $exists
            ->select('COUNT(*)')
            ->from($db->quoteName('#__pt_project_choice'))
            ->where($conditions)
            ->setLimit(1);

        // If selection exists, delete it.
        if ($db->setQuery($exists)->loadResult())
        {
            $delete
                ->delete($db->quoteName('#__pt_project_choice'))
                ->where($conditions);

            $db->setQuery($delete)->execute();
            return false;
        }
        // Else if selection does not exist, insert it.
        else
        {
            $columns = array('project_id', 'choice_id');
            $values = array($projectID, $choiceID);

            $insert
                ->insert($db->quoteName('#__pt_project_choice'))
                ->columns($db->quoteName($columns))
                ->values(implode(',', $values));

            $db->setQuery($insert)->execute();
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
            ->innerJoin('(' . $getChoices . ') AS CHOICES ON choice_id = id')
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