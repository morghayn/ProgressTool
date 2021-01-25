<?php defined('_JEXEC') or die;

/**
 * (Admin) Class ProgressToolModelDashboard
 *
 * Model for back-end dashboard functionality.
 *
 * @package ProgressTool
 * @subpackage admin
 * @since 0.3.0
 *
 * @author  Morgan Nolan <morgan.nolan@hotmail.com>
 * @link    https://github.com/morghayn
 */
class ProgressToolModelDashboard extends JModelLegacy
{
    public function getProjectCount()
    {
        $db = JFactory::getDbo();
        $getProjectCount = $db->getQuery(true);

        $getProjectCount
            ->select('COUNT(*)')
            ->from($db->quoteName('#__pt_project'));

        return $db->setQuery($getProjectCount)->loadResult();
    }

    public function getSelectionCount()
    {
        $db = JFactory::getDbo();
        $getProjectChoiceCount = $db->getQuery(true);

        $getProjectChoiceCount
            ->select('COUNT(*)')
            ->from($db->quoteName('#__pt_project_choice'));

        return $db->setQuery($getProjectChoiceCount)->loadResult();
    }

    public function getActivatedCount()
    {
        $db = JFactory::getDbo();
        $getProjectCount = $db->getQuery(true);

        $getProjectCount
            ->select('COUNT(*)')
            ->from($db->quoteName('#__pt_project'))
            ->where($db->quoteName('activated') . ' = 1')
            ->andWhere($db->quoteName('deactivated') . ' != 1');

        return $db->setQuery($getProjectCount)->loadResult();
    }

    public function getDeactivatedCount()
    {
        $db = JFactory::getDbo();
        $getProjectCount = $db->getQuery(true);

        $getProjectCount
            ->select('COUNT(*)')
            ->from($db->quoteName('#__pt_project'))
            ->where($db->quoteName('deactivated') . ' = 1');

        return $db->setQuery($getProjectCount)->loadResult();
    }
}