<?php defined('_JEXEC') or die;

/**
 * (Site) Class ProgressToolModelSurvey
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
     * Retrieves object list comprising of the categories of the progress tool.
     *
     * @return object list of all the categories within the progress tool.
     * @since 0.3.0
     */
    public function getCategories()
    {
        $db = JFactory::getDbo();
        $getCategories = $db->getQuery(true);

        $columns = array('id', 'category', 'colour_hex', 'colour_rgb');

        $getCategories
            ->select($db->quoteName($columns))
            ->from($db->quoteName('#__pt_category'))
            ->order('id ASC');

        return $db->setQuery($getCategories)->loadObjectList();
    }

    /**
     * Retrieve a list of location specific questions.
     *
     * @param $countryID int country index used to get location specific questions.
     * @return object list comprising of the location specific questions.
     * @since 0.3.0
     */
    public function getQuestions($countryID)
    {
        $db = JFactory::getDbo();
        $getQuestions = $db->getQuery(true);

        $columns = array('Q.id', 'Q.question', 'CA.colour_hex', 'CA.colour_rgb', 'IMG.filepath');

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

    /**
     * Retrieve a list of location specific choices. Additionally, to indicate whether a project has selected a choice, the project_id attribute has
     * is retrieved via a left join. If a selection has been made, the projectID will be present, else the field will return null.
     *
     * @param int $projectID project index for which selections will be retrieved
     * @param int $countryID country index used to get location specific choices.
     * @return array the choices grouped by their respective questions, with an attribute to indicate whether it has been selected or not.
     * @since 0.1.0
     */
    public function getChoices($projectID, $countryID)
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
            ->where($db->quoteName('CO.country_id') . ' = ' . $db->quote($countryID));

        return $this->groupByQuestionID($db->setQuery($choices)->loadObjectList());
    }

    /**
     * Takes in choices through parameters and returns an array of the choices grouped by question.
     *
     * @param mixed $rows the choice rows which are to be grouped.
     * @return array the choices grouped by question.
     * @since 0.2.6
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

    /**
     * Returns true if selection is already active. Returns false if selection is not active.
     *
     * @param $projectID
     * @param $choiceID
     * @return bool
     * @since 0.5.0
     */
    public function isSelected($projectID, $choiceID)
    {
        $db = JFactory::getDbo();
        $isSelected = $db->getQuery(true);

        $isSelected
            ->select('COUNT(*)')
            ->from($db->quoteName('#__pt_project_choice'))
            ->where(
                array(
                    $db->quoteName('project_id') . ' = ' . $db->quote($projectID),
                    $db->quoteName('choice_id') . ' = ' . $db->quote($choiceID)
                )
            )
            ->setLimit(1);

        return $db->setQuery($isSelected)->loadResult() == 1;
    }

    /**
     * Returns choice object corresponding to choiceID.
     *
     * @param $choiceID
     * @return object choice
     * @since 0.5.0
     */
    public function getChoice($choiceID)
    {
        $db = JFactory::getDbo();
        $getChoice = $db->getQuery(true);

        $getChoice
            ->select('*')
            ->from($db->quoteName('#__pt_question_choice'))
            ->where($db->quoteName('id') . ' = ' . $db->quote($choiceID))
            ->setLimit(1);

        return $db->setQuery($getChoice)->loadObject();
    }

    /**
     * Processes a selection.
     *
     * @param $projectID
     * @param $choiceID
     * @since 0.5.0
     */
    public function selectProjectChoice($projectID, $choiceID)
    {
        $db = JFactory::getDbo();
        $selectChoice = $db->getQuery(true);

        $selectChoice
            ->insert($db->quoteName('#__pt_project_choice'))
            ->columns($db->quoteName(array('project_id', 'choice_id')))
            ->values(implode(',', array($projectID, $choiceID)));

        $db->setQuery($selectChoice)->execute();
    }

    /**
     * Retrieves an array containing the choiceIDs of each selection made by the project for the question of opposite weight. (i.e Yes|No)
     * The function of this is so 'yes choices' may be deselected when a 'no choice' is selected and vise versa.
     *
     * @param $questionID
     * @param $projectID
     * @param $weight
     * @return array|integer
     * @since 0.5.0
     */
    public function getOpposingProjectChoices($questionID, $projectID, $weight)
    {
        $db = JFactory::getDbo();
        $getOpposingProjectChoices = $db->getQuery(true);

        $getOpposingProjectChoices
            ->select($db->quoteName('QC.id'))
            ->from($db->quoteName('#__pt_project_choice', 'PC'))
            ->innerjoin($db->quoteName('#__pt_question_choice', 'QC') . ' ON ' . $db->quoteName('QC.id') . ' = ' . $db->quoteName('PC.choice_id'))
            ->where(
                array(
                    $db->quoteName('QC.question_id') . ' = ' . $db->quote($questionID),
                    $db->quoteName('PC.project_id') . ' = ' . $db->quote($projectID),
                    $db->quoteName('QC.weight') . ($weight == 0 ? ' > 0' : ' = 0')
                )
            );

        return $db->setQuery($getOpposingProjectChoices)->loadColumn();
    }

    /**
     * Processes a deselection.
     *
     * @param $projectID
     * @param $choiceID
     * @since 0.5.0
     */
    public function deselectProjectChoice($projectID, $choiceID)
    {
        $db = JFactory::getDbo();
        $deselectChoice = $db->getQuery(true);

        $deselectChoice
            ->delete($db->quoteName('#__pt_project_choice'))
            ->where(
                array(
                    $db->quoteName('project_id') . ' = ' . $db->quote($projectID),
                    $db->quoteName('choice_id') . ' = ' . $db->quote($choiceID)
                )
            );

        $db->setQuery($deselectChoice)->execute();
    }

    /**
     * Returns the updated score for a question. Used after a selection or deselection is made by a project.
     *
     * @param $questionID
     * @param $projectID
     * @return integer projectQuestionScore
     * @since 0.5.0
     */
    public function getProjectQuestionScore($questionID, $projectID)
    {
        $db = JFactory::getDbo();
        $getProjectQuestionScore = $db->getQuery(true);

        $getProjectQuestionScore
            ->select('IFNULL(SUM(QC.weight), 0) AS userScore')
            ->from($db->quoteName('#__pt_question_choice', 'QC'))
            ->innerjoin($db->quoteName('#__pt_project_choice', 'PC') . ' ON ' . $db->quoteName('QC.id') . ' = ' . $db->quoteName('PC.choice_id'))
            ->where(
                array(
                    $db->quoteName('QC.question_id') . ' = ' . $db->quote($questionID),
                    $db->quoteName('PC.project_id') . ' = ' . $db->quote($projectID)
                )
            )
            ->setLimit(1);

        return $db->setQuery($getProjectQuestionScore)->loadResult();
    }

    /**
     * Returns true if question is considered complete. Returns false if question is not considered complete.
     *
     * @param $questionID
     * @param $projectQuestionScore
     * @return bool
     * @since 0.5.0
     */
    public function isQuestionComplete($questionID, $projectQuestionScore)
    {
        $db = JFactory::getDbo();
        $isQuestionComplete = $db->getQuery(true);

        $isQuestionComplete
            ->select('IF(SUM(QC.weight) = ' . $db->quote($projectQuestionScore) . ', 1, 0) AS isComplete')
            ->from($db->quoteName('#__pt_question_choice', 'QC'))
            ->where($db->quoteName('QC.question_id') . ' = ' . $db->quote($questionID))
            ->setLimit(1);

        return $db->setQuery($isQuestionComplete)->loadResult() == 1;
    }
}