<?php defined('_JEXEC') or die;

/**
 * (Admin) Class ProgressToolModelProjects
 *
 * Model for back-end projects functionality.
 *
 * @package ProgressTool
 * @subpackage admin
 * @since 0.5.0
 *
 * @author  Morgan Nolan <morgan.nolan@hotmail.com>
 * @link    https://github.com/morghayn
 */
class ProgressToolModelProjects extends JModelLegacy
{
    /**
     * Returns all projects on record.
     *
     * @return object list comprising of all projects on record.
     * @since 0.5.0
     */
    public function getProjects()
    {
        $db = JFactory::getDbo();
        $getProjects = $db->getQuery(true);

        $columns = array(
            'P.id',
            'P.user_id',
            'P.group_id',
            'P.name',
            'P.description',
            'P.type_id',
            'P.creation_date',
            'P.activated',
            //'U.name',
            'U.username',
            'U.email'
        );

        $getProjects
            ->select($columns)
            ->from($db->quoteName('#__pt_project', 'P'))
            ->innerjoin($db->quoteName('#__users', 'U') . 'ON P.user_id = U.id');

        return $db->setQuery($getProjects)->loadObjectList();
    }

    public function getProject($projectID)
    {
        $db = JFactory::getDbo();
        $getProjects = $db->getQuery(true);

        $columns = array(
            'P.id',
            'P.user_id',
            'P.group_id',
            'P.name',
            'P.description',
            'P.type_id',
            'P.creation_date',
            'P.activated',
            //'U.name',
            'U.username',
            'U.email'
        );

        $getProjects
            ->select($columns)
            ->from($db->quoteName('#__pt_project', 'P'))
            ->innerjoin($db->quoteName('#__users', 'U') . 'ON P.user_id = U.id')
            ->where($db->quoteName('P.id') . ' = ' . $db->quote($projectID))
            ->setLimit(1);

        return $db->setQuery($getProjects)->loadAssoc();
    }

    public function getProjectForTable($projectID)
    {
        $db = JFactory::getDbo();
        $getProjects = $db->getQuery(true);

        $columns = array(
            $db->quoteName('P.id', 'ID'),
            $db->quoteName('P.user_id', 'User ID'),
            $db->quoteName('P.group_id', 'Group ID'),
            $db->quoteName('P.name', 'Project Name'),
            $db->quoteName('P.description', 'Project Description'),
            $db->quoteName('P.type_id', 'Type ID'),
            $db->quoteName('P.creation_date', 'Creation Date'),
            $db->quoteName('P.activated', 'Activated'),
            //'U.name',
            $db->quoteName('U.username', 'Creator\'s Username'),
            $db->quoteName('U.email', 'Creator\' Email')
        );

        $getProjects
            ->select($columns)
            ->from($db->quoteName('#__pt_project', 'P'))
            ->innerjoin($db->quoteName('#__users', 'U') . 'ON P.user_id = U.id')
            ->where($db->quoteName('P.id') . ' = ' . $db->quote($projectID))
            ->setLimit(1);

        return $db->setQuery($getProjects)->loadAssoc();
    }
}