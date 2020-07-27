<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_progresstool
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

JFormHelper::loadFieldClass('list');

/**
 * ProgressTool Form Field class for the ProgressTool component
 *
 * @since  0.0.1
 */
class JFormFieldProgressTool extends JFormFieldList
{
	/**
	 * The field type.
	 *
	 * @var         string
	 */
	protected $type = 'ProgressTool';

	/**
	 * Method to get a list of options for a list input.
	 *
	 * @return  array  An array of JHtml options.
	 */
	protected function getOptions()
	{
	    // Get a db connection.
		$db    = JFactory::getDBO();

		// Create a new query object.
		$query = $db->getQuery(true);

		// Select all records from the progresstool table.
		$query->select('id,greeting');
		$query->from('#__progresstool');

		// Reset the query using our newly populated query object.
		$db->setQuery((string) $query);

		// Load the results as a list of stdClass objects (will research later on)...
		$messages = $db->loadObjectList();

		// Declaring variable options array()
		$options  = array();

		if ($messages)
		{
			foreach ($messages as $message)
			{
				$options[] = JHtml::_('select.option', $message->id, $message->greeting);
			}
		}

		$options = array_merge(parent::getOptions(), $options);

		return $options;
	}
}