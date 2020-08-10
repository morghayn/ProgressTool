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
     * TODO
     * @since 0.2.6
     */
    public function insertProject($id, $name, $description)
    {
        // Get a db connection.
        $db = JFactory::getDbo();

        // Create a new query object.
        $query = $db->getQuery(true);

        // Insert columns.
        $columns = array('user_id', 'name', 'description');

        // Insert values.
        $values = array($id, $db->quote($name), $db->quote($description));

        // Prepare the insert query.
        $query
            ->insert($db->quoteName('#__project'))
            ->columns($db->quoteName($columns))
            ->values(implode(',', $values));

        // Set the query using our newly populated query object and execute it.
        $db->setQuery($query);
        $db->execute();
    }
}