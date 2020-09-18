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
    public function getQuestion($questionID)
    {
        $db = JFactory::getDbo();
        $getQuestion = $db->getQuery(true);

        $columns = array('Q.id', 'Q.question', 'CA.colour_hex', 'CA.colour_rgb', 'IMG.filepath', 'IMG.width', 'IMG.height', 'IMG.right_offset', 'IMG.bottom_offset');

        $getQuestion
            ->select($db->quoteName($columns))
            ->from($db->quoteName('#__pt_question', 'Q'))
            ->innerjoin($db->quoteName('#__pt_category', 'CA') . ' ON ' . $db->quoteName('Q.category_id') . ' = ' . $db->quoteName('CA.id'))
            ->leftjoin($db->quoteName('#__pt_question_icon', 'IMG') . ' ON ' . $db->quoteName('Q.id') . ' = ' . $db->quoteName('IMG.question_id'))
            ->where($db->quoteName('Q.id') . ' = ' . $db->quote($questionID))
            ->limit(1);

        return $db->setQuery($getQuestion)->loadAssoc();
    }

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

    public function updateChoices($choices)
    {
        $db = JFactory::getDbo();
        $updateChoices = $db->getQuery(true);

        $columns = array('id', 'choice', 'weight');

        $updateChoices
            ->insert($db->quoteName('#__pt_question_choice'))
            ->columns($db->quoteName($columns));

        foreach ($choices as $key => $choice)
        {
            $updateChoices->values($key . ', ' . $db->quote($choice['choice']) . ', ' . $choice['weight']);
        }

        //return $db->replacePrefix((string) $updateChoices) . " ON DUPLICATE KEY UPDATE `choice` = VALUES(`choice`), `weight` = VALUES(`weight`)";
        return $db->setQuery($updateChoices . " ON DUPLICATE KEY UPDATE `choice` = VALUES(`choice`), `weight` = VALUES(`weight`)")->execute();
    }

    public function addNewChoice($questionID)
    {
        $db = JFactory::getDbo();
        $insertChoice = $db->getQuery(true);

        $insertChoice
            ->insert($db->quoteName('#__pt_question_choice'))
            ->columns($db->quoteName('question_id'))
            ->values($db->quote($questionID));

        return $db->setQuery($insertChoice)->execute();
    }

    public function deleteChoice($choiceID)
    {
        $db = JFactory::getDbo();
        $deleteChoice = $db->getQuery(true);

        $deleteChoice
            ->delete($db->quoteName('#__pt_question_choice'))
            ->where($db->quoteName('id') . ' = ' . $db->quote($choiceID));

        return $db->setQuery($deleteChoice)->execute();
    }

    public function addIcon($questionID, $filePath, $width, $height)
    {
        $db = JFactory::getDbo();
        $insertChoice = $db->getQuery(true);

        $columns = array('question_id', 'filepath', 'width', 'height');
        $values = array($questionID, $filePath, $width, $height);

        $insertChoice
            ->insert($db->quoteName('#__pt_question_icon'))
            ->columns($db->quoteName($columns))
            ->values($questionID . ',' . $db->quote($filePath) . ',' . $width . ',' . $height);

        return $db->setQuery($insertChoice)->execute();
    }

    public function updateIcon($data, $questionID)
    {
        $db = JFactory::getDbo();
        $updateIcon = $db->getQuery(true);

        $updateIcon
            ->update($db->quoteName('#__pt_question_icon', 'IMG'))
            ->set($db->quoteName('IMG.right_offset') . ' = ' . $db->quote($data['right']))
            ->set($db->quoteName('IMG.bottom_offset') . ' = ' . $db->quote($data['bottom']))
            ->set($db->quoteName('IMG.width') . ' = ' . $db->quote($data['width']))
            ->set($db->quoteName('IMG.height') . ' = ' . $db->quote($data['height']))
            ->where($db->quoteName('IMG.question_id') . ' = ' . $db->quote($questionID));

        return $db->setQuery($updateIcon)->execute();
    }

    public function deleteIcon($questionID)
    {
        $db = JFactory::getDbo();
        $deleteIcon = $db->getQuery(true);

        $deleteIcon
            ->delete($db->quoteName('#__pt_question_icon'))
            ->where($db->quoteName('question_id') . ' = ' . $db->quote($questionID));

        return $db->setQuery($deleteIcon)->execute();
    }
}