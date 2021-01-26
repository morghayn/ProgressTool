<?php defined('_JEXEC') or die;

/**
 * (Admin) Class ProgressToolModelTest
 *
 * Model for back-end testing area.
 *
 * @package ProgressTool
 * @subpackage admin
 * @since 0.5.0
 *
 * @author  Morgan Nolan <morgan.nolan@hotmail.com>
 * @link    https://github.com/morghayn
 */
class ProgressToolModelTest extends JModelLegacy
{
    public function getProjects()
    {
        $db = JFactory::getDbo();
        $getProjects = $db->getQuery(true);

        $getProjects
            ->select($db->quoteName('P.id'))
            ->from($db->quoteName('#__pt_project', 'P'))
            ->where($db->quoteName('deactivated') . ' != 1');

        return $db->setQuery($getProjects)->loadColumn();
    }

    /**
     * Retrieves the categories within the progress tool. Returns an additional field -- the total weight among all the choices
     * within that category.
     *
     * @param int $countryID the ID of the country.
     * @return object list of all the categories within the progress tool.
     * @since 0.3.0
     */
    public function getCategories($countryID, $projectID)
    {
        $db = JFactory::getDbo();
        $getCategories = $db->getQuery(true);

        $columns = array('CA.id', 'CA.category', 'CA.colour_hex', 'CA.colour_rgb');

        $getCategories
            ->select($db->quoteName($columns))
            ->select('SUM(QC.weight) AS categoryTotal')
            ->select('SUM((IF(' . $db->quoteName('PC.project_id') . ' = ' . $db->quote($projectID) . ', QC.weight, 0))) AS projectTotal')
            ->from($db->quoteName('#__pt_question_choice', 'QC'))
            ->innerjoin($db->quoteName('#__pt_question', 'Q') . ' ON ' . $db->quoteName('QC.question_id') . ' = ' . $db->quoteName('Q.id'))
            ->innerjoin($db->quoteName('#__pt_question_country', 'CO') . ' ON ' . $db->quoteName('Q.id') . ' = ' . $db->quoteName('CO.question_id'))
            ->innerjoin($db->quoteName('#__pt_category', 'CA') . ' ON ' . $db->quoteName('Q.category_id') . ' = ' . $db->quoteName('CA.id'))
            ->leftjoin($db->quoteName('#__pt_project_choice', 'PC') . ' ON ' . $db->quoteName('PC.choice_id') . ' = ' . $db->quoteName('QC.id') . ' AND ' . $db->quoteName('PC.project_id') . ' = ' . $db->quote($projectID))
            ->where($db->quoteName('CO.country_id') . ' = ' . $db->quote($countryID))
            ->group('CA.id')
            ->order('CA.id ASC');

        return $db->setQuery($getCategories)->loadObjectList();
    }
}