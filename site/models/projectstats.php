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
    /**
     * Returns an index to a country String passed through, else returns 1 if not found. Country index of 1 represents the universal question pool.
     *
     * @param string $country the country name.
     * @return int the country index.
     * @since 0.3.0
     */
    public function getCountryIndex($country)
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        $query
            ->select($db->quoteName('C.id'))
            ->from($db->quoteName('#__pt_country', 'C'))
            ->where($db->quoteName('C.country') . ' LIKE ' . $db->quote($country));

        $countryIndex = $db->setQuery($query)->loadResult();
        return is_null($countryIndex) ? 1 : $countryIndex;
    }

    /**
     * Returns associated array containing data pertaining to the project specified in the parameters.
     *
     * @param int $projectID the ID used to identify project.
     * @return mixed associated array of data.
     * @since 0.3.0
     */
    public function getProject($projectID)
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        $columns = array('user_id', 'name', 'activated');

        $query
            ->select($db->quoteName($columns))
            ->from($db->quoteName('#__pt_project'))
            ->where($db->quoteName('id') . ' = ' . $db->quote($projectID));

        return $db->setQuery($query)->loadAssoc();
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

    public function getTasks($countryIndex, $projectID)
    {
        $db = JFactory::getDbo();
        $select = $db->getQuery(true);

        $columns = array('T.id', 'T.task', 'T.category_id', 'TC.criteria');

        $select
            ->select($columns)
            ->select('COUNT(CH.project_id) AS selected')
            ->from($db->quoteName('#__pt_task', 'T'))
            ->innerjoin($db->quoteName('#__pt_task_country', 'TC') . ' ON ' . $db->quoteName('T.id') . ' = ' . $db->quoteName('TC.task_id'))
            ->innerjoin($db->quoteName('#__pt_choice_task', 'CT') . ' ON ' . $db->quoteName('TC.task_id') . ' = ' . $db->quoteName('CT.task_id'))
            ->leftjoin($db->quoteName('#__pt_project_choice', 'CH') . ' ON CT.choice_id = CH.choice_id AND project_id = ' . $db->quote($projectID))
            ->where('TC.country_id = ' . $db->quote($countryIndex))
            ->group('T.id');


        $progressGoals = $db->setQuery($select)->loadObjectList();
        return $this->groupByCategory($progressGoals);
    }

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
}
