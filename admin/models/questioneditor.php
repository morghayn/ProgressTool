<?php defined('_JEXEC') or die;

/**
 * Class ProgressToolModelQuestionEditor
 *
 * Model for back-end question editor functionality.
 *
 * @package ProgressTool
 * @subpackage admin
 * @since 0.5.0
 *
 * @author  Morgan Nolan <morgan.nolan@hotmail.com>
 * @link    https://github.com/morghayn
 */
class ProgressToolModelQuestionEditor extends JModelLegacy
{
    /**
     * TODO: documentation
     *
     * @param $questionID int
     * @return mixed
     * @since 0.5.0
     */
    public function getQuestion($questionID)
    {
        $db = JFactory::getDbo();
        $getQuestion = $db->getQuery(true);

        $columns = array('Q.id', 'Q.question', 'CA.colour_hex', 'CA.colour_rgb');

        $getQuestion
            ->select($db->quoteName($columns))
            ->from($db->quoteName('#__pt_question', 'Q'))
            ->innerjoin($db->quoteName('#__pt_category', 'CA') . ' ON ' . $db->quoteName('Q.category_id') . ' = ' . $db->quoteName('CA.id'))
            ->where($db->quoteName('Q.id') . ' = ' . $db->quote($questionID));

        return $db->setQuery($getQuestion)->loadAssoc();
    }

    /**
     * TODO: documentation
     *
     * @param int $questionID
     * @return mixed
     * @since 0.5.0
     */
    public function getChoices($questionID)
    {
        $db = JFactory::getDbo();
        $getChoice = $db->getQuery(true);

        $columns = array('C.id', 'C.question_id', 'C.choice', 'C.weight');

        $getChoice
            ->select($db->quoteName($columns))
            ->from($db->quoteName('#__pt_question_choice', 'C'))
            ->innerjoin($db->quoteName('#__pt_question', 'Q') . ' ON C.question_id = Q.id')
            ->where($db->quoteName('Q.id') . ' = ' . $db->quote($questionID))
            ->order('C.id');

        return $db->setQuery($getChoice)->loadAssocList();
    }

    public function updateQuestion($questionID, $question)
    {
        $db = JFactory::getDbo();
        $updateQuestion = $db->getQuery(true);

        $updateQuestion
            ->update($db->quoteName('#__pt_question', 'Q'))
            ->set($db->quoteName('Q.question') . ' = ' . $db->quote($question))
            ->where($db->quoteName('Q.id') . ' = ' . $db->quote($questionID));

        return $db->setQuery($updateQuestion)->execute();
    }

    public function addChoice($questionID)
    {
        $db = JFactory::getDbo();
        $insertChoice = $db->getQuery(true);

        $columns = array('question_id');

        $insertChoice
            ->insert($db->quoteName('#__pt_question_choice'))
            ->columns($db->quoteName($columns))
            ->values($db->quote($questionID));

        return $db->setQuery($insertChoice)->execute();
    }
}