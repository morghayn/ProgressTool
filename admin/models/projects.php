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
     */
    public function getProjects()
    {
        $db = JFactory::getDbo();
        $getProjects = $db->getQuery(true);

        $getProjects
            ->select('*')
            ->from($db->quoteName('#__pt_project'));

        return $db->setQuery($getProjects)->loadObjectList();
    }
}