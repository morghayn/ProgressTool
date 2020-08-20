<?php defined('_JEXEC') or die;

/**
 * Class ProgressToolModelProjectStats
 *
 * Model for front-end project stats functionality.
 *
 * @package ProgressTool
 * @subpackage site
 * @since 0.3.0
 *
 * @author  Morgan Nolan <morgan.nolan@hotmail.com>
 * @link    https://github.com/morghayn
 */
class ProgressToolModelProjectStats extends JModelItem
{
    public function groupByCategory($rows)
    {
        $grouped = array();

        foreach ($rows as $row)
        {
            // Grouping by category
            $grouped[$row->category_id][] = $row;
        }

        return $grouped;
    }

    public function getMeasurements()
    {
        $db = JFactory::getDbo();
        $select = $db->getQuery(true);

        $select
            ->select('*')
            ->from($db->quoteName('#__pt_measurement'));

        $measurements = $db->setQuery($select)->loadObjectList();
        return $this->groupByCategory($measurements);
    }

    public function getCategories()
    {
        $db = JFactory::getDbo();
        $select = $db->getQuery(true);

        $select
            ->select('*')
            ->from($db->quoteName('#__pt_category'));

        return $db->setQuery($select)->loadObjectList();
    }

    public function getMeasurementCategories()
    {
        $db = JFactory::getDbo();
        $categories = $db->getQuery(true);

        $categories
            ->select('*')
            ->from($db->quoteName('#__pt_measurement_category'));

        return $db->setQuery($categories)->loadObjectList();
    }

    public function getProgressGoals()
    {
        $db = JFactory::getDbo();
        $select = $db->getQuery(true);

        $select
            ->select('*')
            ->from($db->quoteName('#__pt_progress_goal'));

        $progressGoals = $db->setQuery($select)->loadObjectList();
        return $this->groupByCategory($progressGoals);
    }

}
