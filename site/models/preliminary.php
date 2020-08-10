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
     * Retrieve a list of the preliminary questions.
     *
     * @return mixed list of the preliminary questions.
     * @since 0.2.6
     */
    public function getPreliminaryQuestions()
    {
        // Get a db connection and create a new query object.
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        // Prepare query to retrieve the preliminary questions.
        $query
            ->select($db->quoteName(array('question'))) // TODO: does this have to be an array?
            ->from($db->quoteName('#__preliminary_question'));

        // Set query, and return questions as a list of stdClass objects.
        return $db->setQuery($query)->loadObjectList();
    }
}
