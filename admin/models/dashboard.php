<?php defined('_JEXEC') or die;

/**
 * Class ProgressToolModelDashboard
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
    public function test($userID)
    {
        $db = JFactory::getDbo();
        $getGroupMemebers = $db->getQuery(true);

        $getGroupMemebers
            ->select('*')
            ->from($db->quoteName('#__community_groups_members'))
            ->where($db->quoteName('memberid') . ' = ' . $db->quote($userID));

        return $db->setQuery($getGroupMemebers)->loadObjectList();
    }
}