<?php defined('_JEXEC') or die;

/**
 * (Site) Class ProgressToolModelProjectStats
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
     * Returns the countryID associated with countryString, else if not found returns 1 if not found.
     *
     * @param string $countryString the country name.
     * @return int the countryID.
     * @since 0.3.0
     */
    public function getCountryID($countryString)
    {
        $db = JFactory::getDbo();
        $getCountryID = $db->getQuery(true);

        $getCountryID
            ->select($db->quoteName('C.id'))
            ->from($db->quoteName('#__pt_country', 'C'))
            ->where($db->quoteName('C.country') . ' LIKE ' . $db->quote($countryString));

        $countryID = $db->setQuery($getCountryID)->loadResult();
        return is_null($countryID) ? 1 : $countryID;
    }

    /**
     * Returns an associative array containing data linked to the projectID specified.
     *
     * @param int $projectID the ID used to identify project.
     * @return mixed an associative array of data.
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

    /**
     * Retrieves all tasks specific to users country. Includes a column named selected in which the number of choices selected associated with a
     * specific task are counted.
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

        $columns = array('T.id', 'T.task', 'T.category_id', 'TC.criteria');

        $getTasks
            ->select($columns)
            ->select('COUNT(CH.project_id) AS selected')
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
     * Retrieves the categories within the progress tool. Returns an additional field -- the total weight among all the choices
     * within that category.
     *
     * @param $countryID the ID of the country.
     * @return object list of all the categories within the progress tool.
     * @since 0.3.0
     */
    public function getCategories($countryID)
    {
        $db = JFactory::getDbo();
        $getCategories = $db->getQuery(true);

        $columns = array('CA.id', 'CA.category', 'CA.colour_hex', 'CA.colour_rgb');

        $getCategories
            ->select($columns)
            ->select('SUM(QC.weight) AS total')
            ->from($db->quoteName('#__pt_question_choice', 'QC'))
            ->innerjoin($db->quoteName('#__pt_question', 'Q') . ' ON ' . $db->quoteName('QC.question_id') . ' = ' . $db->quoteName('Q.id'))
            ->innerjoin($db->quoteName('#__pt_question_country', 'CO') . ' ON ' . $db->quoteName('Q.id') . ' = ' . $db->quoteName('CO.question_id'))
            ->innerjoin($db->quoteName('#__pt_category', 'CA') . ' ON ' . $db->quoteName('Q.category_id') . ' = ' . $db->quoteName('CA.id'))
            ->where($db->quoteName('CO.country_id') . ' = ' . $db->quote($countryID))
            ->group('CA.id')
            ->order('CA.id ASC');

        return $db->setQuery($getCategories)->loadObjectList();
    }

    /**
     * // TODO documentation here
     *
     * @param int $countryID the ID of the country.
     * @param int $projectID the ID of the project.
     * @return mixed
     * @since 0.3.0
     */
    public function getTotals($countryID, $projectID)
    {
        $db = JFactory::getDbo();
        $getTotals = $db->getQuery(true);

        $getTotals
            ->select($db->quoteName('CA.id'))
            ->select('SUM(QC.weight) AS total')
            ->from($db->quoteName('#__pt_project_choice', 'PC'))
            ->innerjoin($db->quoteName('#__pt_question_choice', 'QC') . ' ON ' . $db->quoteName('PC.choice_id') . ' = ' . $db->quoteName('QC.id'))
            ->innerjoin($db->quoteName('#__pt_question', 'Q') . ' ON ' . $db->quoteName('QC.question_id') . ' = ' . $db->quoteName('Q.id'))
            ->innerjoin($db->quoteName('#__pt_question_country', 'CO') . ' ON ' . $db->quoteName('Q.id') . ' = ' . $db->quoteName('CO.question_id'))
            ->innerjoin($db->quoteName('#__pt_category', 'CA') . ' ON ' . $db->quoteName('Q.category_id') . ' = ' . $db->quoteName('CA.id'))
            ->where($db->quotename('CO.country_id') . ' = ' . $db->quote($countryID))
            ->where($db->quoteName('PC.project_id') . ' = ' . $db->quote($projectID))
            ->group('CA.id');

        $debug = $db->replacePrefix((string) $getTotals);
        var_dump($debug);

        return $db->setQuery($getTotals)->loadAssocList('id', 'total');
    }
}
