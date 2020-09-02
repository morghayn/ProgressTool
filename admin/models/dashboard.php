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
    public function test()
    {
        $db = JFactory::getDbo();
        $getTasks = $db->getQuery(true);

        $getTasks
            ->select('*')
            ->from($db->quoteName('#__community_groups_members'));

        return $db->setQuery($getTasks)->loadObjectList();
    }
}