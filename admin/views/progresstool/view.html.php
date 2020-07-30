<?php defined('_JEXEC') or die;

/**
 * Class ProgressToolViewProgressTool
 *
 * View for back-end administrator functionality.
 *
 * @package ProgressTool
 * @subpackage admin
 * @since 0.0.9
 *
 * @author  Morgan Nolan <morgan.nolan@hotmail.com>
 * @link    https://github.com/morghayn
 * @license GNU General Public License version 2 or later; see LICENSE.txt
 */
class ProgressToolViewProgressTool extends JViewLegacy
{
    /**
     * Renders view.
     *
     * @param null $tpl use default template.
     * @since 0.0.9
     */
    function display($tpl = null)
    {
        $this->questions = array();
        $this->questions = $this->get('Questions');

        $this->question_choices = array();
        $this->question_choices = $this->get('Choices');

        $document = JFactory::getDocument();
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/survey_admin.css");

        /* Check for errors.
        if (count($errors = $this->get('Errors')))
        {
            JLog::add(implode('<br />', $errors), JLog::WARNING, 'jerror');

            return false;
        } */

        // Display the view
        parent::display($tpl);
    }
}