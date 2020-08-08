<?php defined('_JEXEC') or die;

/**
 * Class ProgressToolViewPreliminary
 *
 * View for front-end preliminary functionality.
 *
 * @package ProgressTool
 * @subpackage site
 * @since 0.1.2
 *
 * @author  Morgan Nolan <morgan.nolan@hotmail.com>
 * @link    https://github.com/morghayn
 * @license GNU General Public License version 2 or later; see LICENSE.txt
 */
class ProgressToolViewPreliminary extends JViewLegacy
{
    /**
     * Renders view.
     *
     * @param null $tpl use default template.
     * @since 0.1.2
     */
	function display($tpl = null)
	{
	    // Retrieving preliminary questions
	    $this->questions = array();
	    $this->questions = $this->get('Questions');

	    // Adding CSS
        $document = JFactory::getDocument();
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/preliminary.css");

		// Display the view
		parent::display($tpl);
	}
}