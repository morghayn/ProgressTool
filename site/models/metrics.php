<?php defined('_JEXEC') or die;

/**
 * (Site) Class ProgressToolModelMetrics
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
class ProgressToolModelMetrics extends JModelItem
{
    /**
     * Retrieves all tasks specific to users country. Includes a column 'criteria_met', will be 1 to represent true if it has been determined that
     * the criteria for that task has been met.
     *
     * @param int $countryID the ID of the country.
     * @param int $projectID the ID of the project in which the selections will be counted.
     * @return array an array of the tasks grouped by their designated category.
     * @since 0.3.0
     */
    public function getTasks($countryID, $projectID)
    {
        $db = JFactory::getDbo();
        $getTasks = $db->getQuery(true);

        $columns = array('T.id', 'T.task', 'T.category_id');

        $getTasks
            ->select($columns)
            ->select('IF(TC.criteria <= COUNT(CH.project_id), 1, 0) AS criteria_met')
            ->from($db->quoteName('#__pt_task', 'T'))
            ->innerjoin($db->quoteName('#__pt_task_country', 'TC') . ' ON ' . $db->quoteName('T.id') . ' = ' . $db->quoteName('TC.task_id'))
            ->innerjoin($db->quoteName('#__pt_choice_task', 'CT') . ' ON ' . $db->quoteName('TC.task_id') . ' = ' . $db->quoteName('CT.task_id'))
            ->leftjoin($db->quoteName('#__pt_project_choice', 'CH') . ' ON CT.choice_id = CH.choice_id AND project_id = ' . $db->quote($projectID))
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
     * @since 0.5.0
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

    /**
     * Retrieves the timeline categories. Also calculates and returns project progress within each category.
     *
     * @param int $countryID the ID of the country.
     * @return object list of all the categories within the progress tool.
     * @since 0.3.0
     */
    public function getCategories($countryID, $projectID)
    {
        $db = JFactory::getDbo();
        $getCategories = $db->getQuery(true);

        $columns = array(
            'CA.id',
            'CA.category',
            'CA.colour_hex',
            'CA.colour_rgb'
        );

        // Selections for project total selection and category total selections
        $projectTotal = 'SUM((IF(' . $db->quoteName('PC.project_id') . ' = ' . $db->quote($projectID) . ', QC.weight, 0)))';
        $categoryTotal = 'SUM(QC.weight)';

        $getCategories
            ->select($db->quoteName($columns))
            ->select('ROUND((' . $projectTotal . ' / ' . $categoryTotal . ') * 100) AS progress')
            ->from($db->quoteName('#__pt_question_choice', 'QC'))
            ->innerJoin($db->quoteName('#__pt_question', 'Q') . ' ON ' . $db->quoteName('QC.question_id') . ' = ' . $db->quoteName('Q.id'))
            ->innerJoin($db->quoteName('#__pt_question_country', 'CO') . ' ON ' . $db->quoteName('Q.id') . ' = ' . $db->quoteName('CO.question_id'))
            ->innerJoin($db->quoteName('#__pt_category', 'CA') . ' ON ' . $db->quoteName('Q.category_id') . ' = ' . $db->quoteName('CA.id'))
            ->leftJoin($db->quoteName('#__pt_project_choice', 'PC') . ' ON ' . $db->quoteName('PC.choice_id') . ' = ' . $db->quoteName('QC.id') . ' AND ' . $db->quoteName('PC.project_id') . ' = ' . $db->quote($projectID))
            ->where($db->quoteName('CO.country_id') . ' = ' . $countryID)
            ->group('CA.id')
            ->order('CA.id ASC');

        return $db->setQuery($getCategories)->loadObjectList();
    }
}
