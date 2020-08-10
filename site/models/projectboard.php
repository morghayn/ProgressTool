<?php defined('_JEXEC') or die;

/**
 * Class ProgressToolModelProjectBoard
 *
 * Model for front-end project-board functionality.
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
     * Retrieve a user's projects.
     *
     * @return mixed a user's projects.
     * @since 0.1.6
     */
    public function getUserProjects($user_id)
    {
        // Get a db connection.
        $db = JFactory::getDbo();

        // Create a new query object.
        $query = $db->getQuery(true);

        // Select all records from #__question
        $query->select($db->quoteName(array('id', 'name', 'description')));
        $query->from($db->quoteName('#__project'));
        $query->where($db->quoteName('user_id') . ' = ' . $db->quote($user_id));
        // todo something with this $query->order('ordering ASC');

        // Reset the query using our newly populated query object.
        $db->setQuery($query);
        // Reset the query using our newly populated query object.
        //$this->test = $db->setQuery($query);
        //var_dump($this->test);

        // Load the results as a list of stdClass objects (see later for more options on retrieving data).
        return $db->loadObjectList();
    }
}