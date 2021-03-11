<?php defined('_JEXEC') or die;

/**
 * (Admin) Class ProgressToolModelPools
 *
 * Model for back-end question pools functionality.
 *
 * @package ProgressTool
 * @subpackage admin
 * @since 0.5.0
 *
 * @author  Morgan Nolan <morgan.nolan@hotmail.com>
 * @link    https://github.com/morghayn
 */
class ProgressToolModelTasks extends JModelLegacy
{
    /**
     * Retrieves object list comprising of the categories.
     *
     * @return object
     * @since 0.5.5
     */
    public function getCategories()
    {
        $db = JFactory::getDbo();
        $getCategories = $db->getQuery(true);

        $getCategories
            ->select(
                array(
                    'id',
                    'category',
                    'colour_hex',
                    'colour_rgb'
                )
            )
            ->from($db->quoteName('#__pt_category'))
            ->order('id ASC');

        return $db->setQuery($getCategories)->loadObjectList();
    }

    /**
     * Returns array of task objects and nests associated choices accordingly.
     *
     * @param $countryID
     * @return array
     * @since 0.5.5
     */
    public function getTasks($countryID)
    {
        $db = JFactory::getDbo();
        $getTasks = $db->getQuery(true);

        $getTasks
            ->select(
                array(
                    'T.id',
                    'T.task',
                    'T.category_id',
                    'TC.criteria',
                    'TC.logic_id'
                )
            )
            ->from($db->quoteName('#__pt_task', 'T'))
            ->innerJoin($db->quoteName('#__pt_task_country', 'TC') . ' ON ' . $db->quoteName('T.id') . ' = ' . $db->quoteName('TC.task_id'))
            ->innerJoin($db->quoteName('#__pt_choice_task', 'CT') . ' ON ' . $db->quoteName('TC.task_id') . ' = ' . $db->quoteName('CT.task_id'))
            ->where('TC.country_id = ' . $db->quote($countryID))
            ->group('T.id');

        // setting the index for tasks in the tasks object as the task id
        $tasks = array();
        $sequentiallyOrderedTasks = $db->setQuery($getTasks)->loadObjectList();
        foreach ($sequentiallyOrderedTasks as $task):
            $tasks[$task->id] = $task;
            $tasks[$task->id]->choices = array();
        endforeach;

        // adding choice objects to each task within tasks object
        $choices = $this->getTaskChoices($countryID);
        foreach ($choices as $choice):
            if (array_key_exists($choice->task_id, $tasks)):
                $tasks[$choice->task_id]->choices[$choice->id] = $choice;
            endif;
        endforeach;

        return $tasks;
    }

    /**
     * Retrieves choices associated with tasks of a particular country.
     *
     * @param $countryID
     * @return array
     * @since 0.5.5
     */
    public function getTaskChoices($countryID)
    {
        $db = JFactory::getDbo();
        $getChoices = $db->getQuery(true);

        $getChoices
            ->select(
                array(
                    'T.task_id',
                    'CH.id',
                    'CH.question_id',
                    'CH.choice',
                    'CH.weight'
                )
            )
            ->from($db->quoteName('#__pt_choice_task', 'T'))
            ->innerJoin($db->quoteName('#__pt_question_choice', 'CH') . ' ON CH.id = T.choice_id')
            ->innerJoin($db->quoteName('#__pt_question', 'Q') . ' ON Q.id = CH.question_id')
            ->innerJoin($db->quoteName('#__pt_question_country', 'CO') . ' ON CO.question_id = Q.id')
            ->where($db->quoteName('CO.country_id') . ' = ' . $db->quote($countryID));

        return $db->setQuery($getChoices)->loadObjectList();
    }

    /**
     * Retrieves choices a particular country.
     *
     * @param $countryID
     * @return array
     * @since 0.5.5
     */
    public function getChoices($countryID)
    {
        $db = JFactory::getDbo();
        $getChoices = $db->getQuery(true);

        $getChoices
            ->select(
                array(
                    'CH.id',
                    'CH.question_id',
                    'CH.choice',
                    'CH.weight'
                )
            )
            ->from($db->quoteName('#__pt_question_choice', 'CH'))
            ->innerJoin($db->quoteName('#__pt_question', 'Q') . ' ON Q.id = CH.question_id')
            ->innerJoin($db->quoteName('#__pt_question_country', 'CO') . ' ON CO.question_id = Q.id')
            ->where($db->quoteName('CO.country_id') . ' = ' . $db->quote($countryID));

        return $db->setQuery($getChoices)->loadObjectList();
    }

    /**
     * Removes a particular choice from a task.
     *
     * @param $countryID
     * @param $taskID
     * @param $choiceID
     * @return bool
     * @since 0.5.0
     */
    public function removeChoice($countryID, $taskID, $choiceID)
    {
        $db = JFactory::getDbo();
        $removeChoice = $db->getQuery(true);

        $removeChoice
            ->delete($db->quoteName('#__pt_choice_task'))
            ->where(
                array(
                    $db->quoteName('task_id') . ' = ' . $db->quote($taskID),
                    $db->quoteName('choice_id') . ' = ' . $db->quote($choiceID)
                )
            );

        $db->setQuery($removeChoice)->execute();
        $this->updateCriteria($countryID, $taskID);
        return true;
    }

    /**
     * Updates the logic id of a task for a particular country.
     *
     * @param $countryID
     * @param $taskID
     * @param $logicID
     * @return bool
     * @since 0.5.0
     */
    public function updateLogicID($countryID, $taskID, $logicID)
    {
        $db = JFactory::getDbo();
        $updateLogic = $db->getQuery(true);

        $columns = array('country_id', 'task_id', 'logic_id');

        $updateLogic
            ->insert($db->quoteName('#__pt_task_country'))
            ->columns($db->quoteName($columns))
            ->values($countryID . ', ' . $taskID . ', ' . $logicID);

        $db->setQuery($updateLogic . " ON DUPLICATE KEY UPDATE `logic_id` = VALUES(`logic_id`)")->execute();
        $this->updateCriteria($countryID, $taskID);
        return true;
    }

    /**
     * Updates the criteria of a task for a particular country.
     * @param $countryID
     * @param $taskID
     * @return mixed
     * @since 0.5.0
     */
    public function updateCriteria($countryID, $taskID)
    {
        $db = JFactory::getDbo();
        $updateCriteria = $db->getQuery(true);

        $columns = array('country_id', 'task_id', 'criteria');
        $criteria = $this->getCriteria($countryID, $taskID);

        $updateCriteria
            ->insert($db->quoteName('#__pt_task_country'))
            ->columns($db->quoteName($columns))
            ->values($countryID . ', ' . $taskID . ', ' . $criteria);

        return $db->setQuery($updateCriteria . " ON DUPLICATE KEY UPDATE `criteria` = VALUES(`criteria`)")->execute();
    }

    /**
     * Gets a tasks criteria via calculation.
     * We get the min() if logic is 'OR' else we get max().
     *
     * @param $countryID
     * @param $taskID
     * @return integer
     * @since 0.5.0
     */
    public function getCriteria($countryID, $taskID)
    {
        $logic = $this->getLogicID($countryID, $taskID);
        $operation = ($logic == 0 ? 'MIN' : 'SUM');

        $db = JFactory::getDbo();
        $getUpdatedWeight = $db->getQuery(true);

        $getUpdatedWeight
            ->select($operation . '(QC.weight)')
            ->from($db->quoteName('#__pt_choice_task', 'CT'))
            ->innerJoin($db->quoteName('#__pt_question_choice', 'QC') . ' ON CT.choice_id = QC.id')
            ->innerJoin($db->quoteName('#__pt_question_country', 'QCO') . ' ON QC.question_id = QCO.question_id')
            ->innerJoin($db->quoteName('#__pt_country', 'C') . ' ON QCO.country_id = C.id')
            ->where(array(
                $db->quoteName('C.id') . ' = ' . $db->quote($countryID),
                $db->quoteName('CT.task_id') . ' = ' . $db->quote($taskID)
            ));

        return $db->setQuery($getUpdatedWeight)->loadResult();
    }

    /**
     * Receives the logic id of a task for a particular country.
     * 0 == OR LOGIC
     * 1== AND LOGIC
     *
     * @param $countryID
     * @param $taskID
     * @return integer
     * @since 0.5.0
     */
    public function getLogicID($countryID, $taskID)
    {
        $db = JFactory::getDbo();
        $getTaskLogic = $db->getQuery(true);

        $getTaskLogic
            ->select($db->quoteName('logic_id'))
            ->from($db->quoteName('#__pt_task_country'))
            ->where(array(
                $db->quoteName('task_id') . ' = ' . $db->quote($taskID),
                $db->quoteName('country_id') . ' = ' . $db->quote($countryID)
            ));

        return $db->setQuery($getTaskLogic)->loadResult();
    }
}