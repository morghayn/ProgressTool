<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_progresstool
 */
// No direct access
defined('_JEXEC') or die('Restricted access');

/**
 * ProgressTool Table class
 *
 * @since  0.0.1
 */
class ProgressToolTableProgressTool extends JTable
{
	/**
	 * Constructor
	 *
	 * @param   JDatabaseDriver  &$db  A database connector object
	 */
	function __construct(&$db)
	{
		parent::__construct('#__progresstool', 'id', $db);
	}
}
