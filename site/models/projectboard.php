<?php defined('_JEXEC') or die;

/**
 * Class ProgressToolModelProjectBoard
 *
 * Model for front-end project board functionality.
 *
 * @package ProgressTool
 * @subpackage site
 * @since 0.1.6
 *
 * @author  Morgan Nolan <morgan.nolan@hotmail.com>
 * @link    https://github.com/morghayn
 * @license GNU General Public License version 2 or later; see LICENSE.txt
 */
class ProgressToolModelProjectBoard extends JModelItem
{
    /**
     * Retrieve a list of a user's projects.
     *
     * @param int $userID the user id of which the project belongs.
     * @return mixed a list of the user's projects
     * @since 0.1.6
     */
    public function getUserProjects($userID)
    {
        // Get a db connection and create a new query object.
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        // Columns to be retrieved.
        $columns = array('id', 'name', 'description');

        // Preparing query to retrieve a user's projects.
        $query
            ->select($db->quoteName($columns))
            ->from($db->quoteName('#__project'))
            ->where($db->quoteName('user_id') . ' = ' . $db->quote($userID));
        // TODO: $query->order('ordering ASC');

        // Set query, execute and return projects as a list of stdClass objects.
        return $db->setQuery($query)->loadObjectList();
    }
}