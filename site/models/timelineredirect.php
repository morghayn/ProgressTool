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
    public function getRedirects($categoryGroups)
    {
        $timelineRedirect = array();
        foreach ($categoryGroups As $categoryGroup)
        {
            $redirect = '';
            $currentCategoryID = '';
            $currentSection = '';
            $flag = false;

            foreach ($categoryGroup As $section)
            {
                $currentCategoryID = $section->category_id;

                /**
                 * If all tasks have been met within a section on the timeline,
                 * set a flag so the url path will be set to the next section on the timeline.
                 * Sets the url path to the current section's path first just in case this is the last section of the timeline.
                 */
                if ($section->criteria_met == 1)
                {
                    $flag = true;
                    $redirect = $section->timeline_url_path;
                    $currentSection = $section->section;
                    continue;
                }
                /**
                 * Flag was set to true so the project is known to be in this section,
                 * set the redirect to the path and then continue to check the next sections
                 */
                elseif($flag == true)
                {
                    $flag = false;
                    $redirect = $section->timeline_url_path;
                    $currentSection = $section->section;
                    continue;
                }
                /**
                 * From the other conditions we have determined the project does not meet the criteria for this section,
                 * However the project does have some of the tasks complete within this section,
                 * so it is safe to say the project is within this section currently.
                 */
                elseif ($section->project_total > 0)
                {
                    $redirect = $section->timeline_url_path;
                    $currentSection = $section->section;
                    break; // TODO: should this be continue or break? Which is better for the UX.
                }
                /**
                 * The project has no tasks done within this section, and has no prior sections completed,
                 * so we can say it is not currently within this section, or furthermore, not even on the timeline yet for this category.
                 */
                else
                {
                    break;
                }
            }

            $tempAssoc = array(
                "redirect" => ($redirect == '' ? '' : '/timeline/' . $redirect . $categoryGroup[0]->timeline_url_fragment),
                "currentSection" => $currentSection
            );

            $timelineRedirect[$currentCategoryID] = $tempAssoc;
        }

        return $timelineRedirect;
    }

    /**
     * @param int $countryID the ID of the country.
     * @param int $projectID the ID of the project.
     * @since 0.5.0
     */
    public function getCategoryGroups($countryID, $projectID)
    {
        $db = JFactory::getDbo();
        $getSectionTotals = $db->getQuery(true);
        $subQuery = $db->getQuery(true);

        $subQueryColumns = array('T.id', 'T.section_id', 'T.task', 'T.category_id');

        $subQuery
            ->select($subQueryColumns)
            ->select('IF(TC.criteria <= COUNT(CH.project_id), 1, 0) AS criteria_met')
            ->from($db->quoteName('#__pt_task', 'T'))
            ->innerjoin($db->quoteName('#__pt_task_country', 'TC') . ' ON ' . $db->quoteName('T.id') . ' = ' . $db->quoteName('TC.task_id'))
            ->innerjoin($db->quoteName('#__pt_choice_task', 'CT') . ' ON ' . $db->quoteName('TC.task_id') . ' = ' . $db->quoteName('CT.task_id'))
            ->leftjoin($db->quoteName('#__pt_project_choice', 'CH') . ' ON CT.choice_id = CH.choice_id AND project_id = ' . $db->quote($projectID))
            ->where('TC.country_id = ' . $db->quote($countryID))
            ->group('T.id');

        $columns = array('T.category_id', 'T.section_id', 'S.section', 'C.timeline_url_fragment', 'S.timeline_url_path');

        $getSectionTotals
            ->select($db->quoteName($columns))
            ->select('COUNT(T.id) AS total')
            ->select('SUM(T.criteria_met) AS project_total')
            ->select('IF(COUNT(T.id) = SUM(T.criteria_met), 1, 0) AS criteria_met')
            ->from($db->quoteName('#__pt_section', 'S'))
            ->innerjoin('(' . $subQuery . ') AS T ON S.id = T.section_id')
            ->innerjoin($db->quoteName('#__pt_category', 'C') . ' ON ' . $db->quoteName('T.category_id') . ' = ' . $db->quoteName('C.id'))
            ->group('S.id, T.category_id')
            ->order('T.category_id, T.section_id ASC');

        // Returns categoryGroups
        return $this->groupByCategory(
            $db->setQuery($getSectionTotals)->loadObjectList()
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
}