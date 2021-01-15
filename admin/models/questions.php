<?php defined('_JEXEC') or die;

/**
 * (Admin) Class ProgressToolModelQuestions
 *
 * Model for back-end question questions functionality.
 *
 * @package ProgressTool
 * @subpackage admin
 * @since 0.5.0
 *
 * @author  Morgan Nolan <morgan.nolan@hotmail.com>
 * @link    https://github.com/morghayn
 */
class ProgressToolModelQuestions extends JModelLegacy
{
    // Questions

    /**
     * Retrieve a list of location specific questions.
     *
     * @param $countryID int country index used to get location specific questions.
     * @return object list comprising of the location specific questions.
     * @since 0.5.0
     */
    public function getQuestions($countryID)
    {
        $db = JFactory::getDbo();
        $getQuestions = $db->getQuery(true);

        $columns = array(
            'Q.id', 'Q.question', 'CA.colour_hex', 'CA.colour_rgb',
            'IMG.filepath', 'IMG.width', 'IMG.height', 'IMG.right_offset', 'IMG.bottom_offset'
        );

        $concat = (
            "CONCAT(" .
            "'width:', IMG.width, 'px; ', " .
            "'height:', IMG.height, 'px; ', " .
            "'right:', IMG.right_offset, 'px; ', " .
            "'bottom:', IMG.bottom_offset, 'px; ') AS image_attributes"
        );

        $getQuestions
            ->select($db->quoteName($columns))
            ->select($concat)
            ->select('SUM(CH.weight) as total')
            ->from($db->quoteName('#__pt_question', 'Q'))
            ->innerjoin($db->quoteName('#__pt_question_country', 'CO') . ' ON ' . $db->quoteName('Q.id') . ' = ' . $db->quoteName('CO.question_id'))
            ->innerjoin($db->quoteName('#__pt_question_choice', 'CH') . ' ON ' . $db->quoteName('Q.id') . ' = ' . $db->quoteName('CH.question_id'))
            ->innerjoin($db->quoteName('#__pt_category', 'CA') . ' ON ' . $db->quoteName('Q.category_id') . ' = ' . $db->quoteName('CA.id'))
            ->leftjoin($db->quoteName('#__pt_question_icon', 'IMG') . ' ON ' . $db->quoteName('Q.id') . ' = ' . $db->quoteName('IMG.question_id'))
            ->where($db->quoteName('CO.country_id') . ' = ' . $db->quote($countryID))
            ->group($db->quoteName('Q.id'))
            ->order('Q.id ASC');

        return $db->setQuery($getQuestions)->loadObjectList();
    }

    // Choices

    /**
     * Retrieve a list of location specific choices grouped by question.
     *
     * @param int $countryID country index used to get location specific choices.
     * @return array the choices grouped by their respective questions.
     * @since 0.5.0
     */
    public function getChoices($countryID)
    {
        $db = JFactory::getDbo();
        $choices = $db->getQuery(true);

        $columns = array('CH.id', 'CH.question_id', 'CH.choice', 'CH.weight');

        $choices
            ->select($db->quoteName($columns))
            ->from($db->quoteName('#__pt_question_choice', 'CH'))
            ->innerjoin($db->quoteName('#__pt_question', 'Q') . ' ON CH.question_id = Q.id')
            ->innerjoin($db->quoteName('#__pt_question_country', 'CO') . ' ON Q.id = CO.question_id')
            ->where($db->quoteName('CO.country_id') . ' = ' . $db->quote($countryID));

        return $this->groupByQuestionID($db->setQuery($choices)->loadObjectList());
    }

    /**
     * Takes in choices through parameters and returns an array of the choices grouped by question.
     *
     * @param mixed $rows the choice rows which are to be grouped.
     * @return array the choices grouped by question.
     * @since 0.5.0
     */
    public function groupByQuestionID($rows)
    {
        $groupedChoices = array();

        foreach ($rows as $row)
        {
            // Grouping by questionID.
            $groupedChoices[$row->question_id][] = $row;
        }

        return $groupedChoices;
    }
}