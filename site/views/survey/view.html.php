<?php defined('_JEXEC') or die;

/**
 * Class ProgressToolViewSurvey
 *
 * View for front-end survey functionality.
 *
 * @package ProgressTool
 * @subpackage site
 * @since 0.1.0
 *
 * @author  Morgan Nolan <morgan.nolan@hotmail.com>
 * @link    https://github.com/morghayn
 * @license GNU General Public License version 2 or later; see LICENSE.txt
 */
class ProgressToolViewSurvey extends JViewLegacy
{
    /**
     * Renders view.
     *
     * @param null $tpl use default template.
     */
	function display($tpl = null)
	{
	    $this->questions = array();
	    $this->questions = $this->get('Questions');

        $this->question_choices = array();
        $this->question_choices = $this->get('Choices');

        $document = JFactory::getDocument();
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/survey_site.css");

		// Display the view
		parent::display($tpl);
	}
}