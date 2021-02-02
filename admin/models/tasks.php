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
}