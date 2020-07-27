<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_progresstool
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * ProgressToolList Model
 *
 * @since  0.0.1
 */
class ProgressToolModelProgressTools extends JModelList
{
    /**
     * Method to build an SQL query to load the list data.
     *
     * @return      string  An SQL query
     */
    protected function getListQuery()
    {
        // Initialize variables.
        $db    = JFactory::getDbo();
        $query = $db->getQuery(true);

        // Create the base select statement.
        $query->select('*')
            ->from($db->quoteName('#__helloworld'));

        return $query;
    }
}