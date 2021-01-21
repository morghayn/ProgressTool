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

        return $this->groupByCategory(
            $db->setQuery($getTasks)->loadObjectList()
        );
    }

    /**
     * A utility function that groups object lists by categoryID.
     *
     * @param object $rows list of objects which will be grouped.
     * @return array list of objects grouped by categoryID.
     * @since 0.5.5
     */
    public function groupByCategory($rows)
    {
        $grouped = array();

        foreach ($rows as $row)
        {
            $grouped[$row->category_id][] = $row;
        }

        return $grouped;
    }
}