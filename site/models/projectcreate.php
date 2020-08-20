<?php defined('_JEXEC') or die;
/**
 * Class ProgressToolModelProjectCreate
 *
 * Model for front-end project creation functionality.
 *
 * @package ProgressTool
 * @subpackage site
 * @since 0.2.5
 *
 * @author  Morgan Nolan <morgan.nolan@hotmail.com>
 * @link    https://github.com/morghayn
 */
class ProgressToolModelProjectCreate extends JModelItem
{
    /**
     * Inserts a new project into the #__pt_projects table.
     *
     * @param int $userID ID of the current user.
     * @param string $name name of the project.
     * @param string $description description of the project.
     * @since 0.2.6
     */
    public function insertProject($userID, $name, $description)
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        $columns = array('user_id', 'name', 'description');
        $values = array($userID, $db->quote($name), $db->quote($description));

        $query
            ->insert($db->quoteName('#__pt_project'))
            ->columns($db->quoteName($columns))
            ->values(implode(',', $values));

        $db->setQuery($query)->execute();
    }
}
