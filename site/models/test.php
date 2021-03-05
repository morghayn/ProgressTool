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
    /**
     * Retrieves all projects belonging to a user.
     *
     * @param int $userID ID of the user.
     * @return mixed object list of all projects belonging to the user.
     * @since 0.1.6
     */
    public function getProjects($userID)
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        $query
            ->select($db->quoteName('P.id', 'P.name', 'T.type'))
            ->from($db->quoteName('#__pt_project', 'P'))
            ->leftjoin($db->quoteName('#__community_groups_members', 'CGM') . ' ON P.group_id = CGM.groupid')
            ->innerjoin($db->quoteName('#__pt_project_type', 'T') . ' ON T.id = P.type_id')
            ->where(
                $db->quoteName('P.user_id') . ' = ' . $db->quote($userID),
            )
            ->orwhere(array(
                $db->quoteName('CGM.memberid') . ' = ' . $db->quote($userID),
                $db->quoteName('CGM.permissions') . ' = 1'
            ))
            ->andwhere($db->quoteName('P.deactivated') . ' != 1')
            ->group($db->quoteName('P.id'))
            ->order('P.id DESC');
        /*
         * Note: for some reason the queries return duplicates on the production site not on my local site
         * So we must group by projectID to avoid duplicates. I am not aware what is causing this duplication
         */

        return $db->setQuery($query)->loadColumn();
    }

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

    public function getProjectProgress($countryID, $projectID)
    {
        $db = JFactory::getDbo();
        $getCategories = $db->getQuery(true);

        $getCategories
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

    /*
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
    */
}