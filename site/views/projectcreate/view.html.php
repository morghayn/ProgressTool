<?php defined('_JEXEC') or die;

/**
 * Class ProgressToolViewProjectCreate
 *
 * View for front-end project creation functionality.
 *
 * @package ProgressTool
 * @subpackage site
 * @since 0.2.6
 *
 * @author  Morgan Nolan <morgan.nolan@hotmail.com>
 * @link    https://github.com/morghayn
 * @license GNU General Public License version 2 or later; see LICENSE.txt
 */
class ProgressToolViewProjectCreate extends JViewLegacy
{
    /**
     * Renders view.
     *
     * @param null $tpl use default template.
     * @since 0.2.6
     */
	function display($tpl = null)
	{
	    // Adding CSS
        $document = JFactory::getDocument();
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/projectcreate.css");
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/masterChest.css");
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/optionsChest.css");

		// Display the view
		parent::display($tpl);
	}
}