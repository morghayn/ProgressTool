<?php defined('_JEXEC') or die;

/**
 * Class ProgressToolModelImageTest
 *
 * Model for back-end ProgressToolModelImageTest functionality.
 *
 * @package ProgressTool
 * @subpackage admin
 * @since 0.3.0
 *
 * @author  Morgan Nolan <morgan.nolan@hotmail.com>
 * @link    https://github.com/morghayn
 */
class ProgressToolModelImageTest extends JModelLegacy
{
    /**
     * Returns the countryID associated with countryString, else if not found returns 1 if not found.
     *
     * @param string $countryString the country name.
     * @return int the countryID.
     * @since 0.3.0
     */
    public function getCountryID($countryString)
    {
        $db = JFactory::getDbo();
        $getCountryID = $db->getQuery(true);

        $getCountryID
            ->select($db->quoteName('C.id'))
            ->from($db->quoteName('#__pt_country', 'C'))
            ->where($db->quoteName('C.country') . ' LIKE ' . $db->quote($countryString));

        $countryID = $db->setQuery($getCountryID)->loadResult();
        return is_null($countryID) ? 1 : $countryID;
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
    public function getChoices($country)
    {
        $db = JFactory::getDbo();
        $choices = $db->getQuery(true);

        $columns = array('CH.id', 'CH.question_id', 'CH.choice', 'CH.weight');

        $choices
            ->select($db->quoteName($columns))
            ->from($db->quoteName('#__pt_question_choice', 'CH'))
            ->innerjoin($db->quoteName('#__pt_question', 'Q') . ' ON CH.question_id = Q.id')
            ->innerjoin($db->quoteName('#__pt_question_country', 'CO') . ' ON Q.id = CO.question_id')
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