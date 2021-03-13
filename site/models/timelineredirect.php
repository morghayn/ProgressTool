<?php defined('_JEXEC') or die;

/**
 * (Site) Class ProgressToolModelTimelineRedirect
 *
 * Model for timeline redirects.
 *
 * @package ProgressTool
 * @subpackage site
 * @since 0.5.0
 *
 * @author  Morgan Nolan <morgan.nolan@hotmail.com>
 * @link    https://github.com/morghayn
 */
class ProgressToolModelTimelineRedirect extends JModelItem
{
    /**
     * Returns the progress percent of a particular project for a particular category.
     *
     * @param int $countryID
     * @param int $categoryID
     * @param int $projectID
     * @return object
     * @since 0.5.0
     */
    public function getProgress($countryID, $categoryID, $projectID)
    {
        $db = JFactory::getDbo();
        $getCategories = $db->getQuery(true);

        // Selections for project total selection and category total selections
        $projectTotal = 'SUM((IF(' . $db->quoteName('PC.project_id') . ' = ' . $db->quote($projectID) . ', QC.weight, 0)))';
        $categoryTotal = 'SUM(QC.weight)';

        $getCategories
            ->select('ROUND((' . $projectTotal . ' / ' . $categoryTotal . ') * 100) AS progress')
            ->from($db->quoteName('#__pt_question_choice', 'QC'))
            ->innerJoin($db->quoteName('#__pt_question', 'Q') . ' ON ' . $db->quoteName('QC.question_id') . ' = ' . $db->quoteName('Q.id'))
            ->innerJoin($db->quoteName('#__pt_question_country', 'CO') . ' ON ' . $db->quoteName('Q.id') . ' = ' . $db->quoteName('CO.question_id'))
            ->innerJoin($db->quoteName('#__pt_category', 'CA') . ' ON ' . $db->quoteName('Q.category_id') . ' = ' . $db->quoteName('CA.id'))
            ->leftJoin($db->quoteName('#__pt_project_choice', 'PC') . ' ON ' . $db->quoteName('PC.choice_id') . ' = ' . $db->quoteName('QC.id') . ' AND ' . $db->quoteName('PC.project_id') . ' = ' . $db->quote($projectID))
            ->where(array(
                $db->quoteName('CO.country_id') . ' = ' . $countryID,
                $db->quoteName('CA.id') . ' = ' . $categoryID
            ))
            ->group('CA.id')
            ->order('CA.id ASC')
            ->limit(1);

        return $db->setQuery($getCategories)->loadResult();
    }

    public function getRedirects($categoryID, $progress)
    {
        $db = JFactory::getDbo();
        $getRedirection = $db->getQuery(true);

        $columns = array(
            'S.timeline_url_path',
            'C.timeline_url_fragment'
        );

        $getRedirection
            ->select($db->quoteName($columns))
            ->from($db->quoteName('#__pt_category_section', 'CS'))
            ->innerJoin($db->quoteName('#__pt_category', 'C') . ' ON C.id = CS.category_id')
            ->innerJoin($db->quoteName('#__pt_section', 'S') . ' ON S.id = CS.section_id')
            ->where(array(
                'C.id = ' . $categoryID,
                'CS.finish_percent > ' . $progress
            ))
            ->order('CS.start_percent ASC')
            ->limit(1);

        // JFactory::getApplication()->redirect($redirects[$categoryID]['redirect'])
        $url = $db->setQuery($getRedirection)->loadObject();
        return '/timeline/' . $url->timeline_url_path . $url->timeline_url_fragment;
    }
}