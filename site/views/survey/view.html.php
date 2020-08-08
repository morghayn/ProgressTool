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
     * @since 0.1.0
     */
	function display($tpl = null)
	{
	    $projectId = 2;
        $model = $this->getModel();
        $this->dirtyImp = $model->getSelected($projectId);

	    $this->questions = array();
	    $this->questions = $this->get('Questions');

        $this->choices = array();
        $this->choices = $this->get('Choices');

        // Adding CSS and JS
        $document = JFactory::getDocument();
        $document->addScript(JURI::root() . "media/com_progresstool/js/survey_site.js");
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/masterChest.css");
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/optionsChest.css");

		// Display the view
		parent::display($tpl);
	}
}