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
}