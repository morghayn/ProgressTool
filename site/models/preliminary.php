<?php defined('_JEXEC') or die;

/**
 * Class ProgressToolModelPreliminary
 *
 * Model for front-end preliminary functionality.
 *
 * @package ProgressTool
 * @subpackage site
 * @since 0.1.2
 *
 * @author  Morgan Nolan <morgan.nolan@hotmail.com>
 * @link    https://github.com/morghayn
 * @license GNU General Public License version 2 or later; see LICENSE.txt
 */
class ProgressToolModelPreliminary extends JModelItem
{
    /**
     * Retrieve preliminary questions.
     *
     * @return mixed preliminary questions.
     * @since 0.1.2
     */
    public function getQuestions()
    {
        // Get a db connection.
        $db = JFactory::getDbo();

        // Create a new query object.
        $query = $db->getQuery(true);

        // Select all records from #__question
        $query->select($db->quoteName(array('question')));
        $query->from($db->quoteName('#__preliminary_question'));

        // Reset the query using our newly populated query object.
        $db->setQuery($query);

        // Load the results as a list of stdClass objects (see later for more options on retrieving data).
        return $db->loadObjectList();
    }
}