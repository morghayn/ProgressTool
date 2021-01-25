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
     * Returns object list comprising of task objects.
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
                    'T.category_id'
                )
            )
            ->from($db->quoteName('#__pt_task', 'T'))
            ->innerjoin($db->quoteName('#__pt_task_country', 'TC') . ' ON ' . $db->quoteName('T.id') . ' = ' . $db->quoteName('TC.task_id'))
            ->innerjoin($db->quoteName('#__pt_choice_task', 'CT') . ' ON ' . $db->quoteName('TC.task_id') . ' = ' . $db->quoteName('CT.task_id'))
            ->where('TC.country_id = ' . $db->quote($countryID))
            ->group('T.id');

        return $db->setQuery($getTasks)->loadObjectList();
    }

    public function getChoices($countryID)
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
            ->innerjoin($db->quoteName('#__pt_question', 'Q') . ' ON Q.id = CH.question_id')
            ->innerjoin($db->quoteName('#__pt_question_country', 'CO') . ' ON CO.question_id = Q.id')
            ->where($db->quoteName('CO.country_id') . ' = ' . $db->quote($countryID));


        $choices = array();
        $rows = $db->setQuery($getChoices)->loadObjectList();

        // Grouping by task_id
        foreach ($rows as $row)
        {
            $choices[$row->task_id][$row->id] = $row;
        }

        return $choices;
    }
}