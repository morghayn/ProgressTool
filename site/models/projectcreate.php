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
 * @license GNU General Public License version 2 or later; see LICENSE.txt
 */
class ProgressToolModelProjectCreate extends JModelItem
{
    /**
     * Inserts a new project into the #__projects table.
     *
     * @param int $userID the user id of which the project belongs.
     * @param string $name the name of the project.
     * @param string $description the description of the project.
     * @since 0.2.6
     */
    public function insertProject($userID, $name, $description)
    {
        // Get a db connection and create a new query object.
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        // Columns to insert into.
        $columns = array('user_id', 'name', 'description');

        // Columns that will be inserted.
        $values = array($userID, $db->quote($name), $db->quote($description));

        // Prepare the insert query.
        $query
            ->insert($db->quoteName('#__project'))
            ->columns($db->quoteName($columns))
            ->values(implode(',', $values));

        // Set query and execute insertion.
        $db->setQuery($query)->execute();
    }
}
