<?php defined('_JEXEC') or die;

/**
 * Class ProgressToolViewAdministrator
 *
 * View for back-end administrator functionality.
 *
 * @package ProgressTool
 * @subpackage admin
 * @since 0.1.2
 *
 * @author  Morgan Nolan <morgan.nolan@hotmail.com>
 * @link    https://github.com/morghayn
 * @license GNU General Public License version 2 or later; see LICENSE.txt
 */
class ProgressToolViewAdministrator extends JViewLegacy
{
    /**
     * Display the Hello World view
     *
     * @param string $tpl The name of the template file to parse; automatically searches through the template paths.
     *
     * @return  void
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
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/survey_admin.css");
        $document->addScript(JURI::root() . "media/com_progresstool/js/survey_site.js");

        // Display the view
        parent::display($tpl);
        /**
         * // Get data from the model
         * $this->items        = $this->get('Items');
         * $this->pagination    = $this->get('Pagination');
         *
         * // Check for errors.
         * if (count($errors = $this->get('Errors')))
         * {
         * JError::raiseError(500, implode('<br />', $errors));
         *
         * return false;
         * }
         *
         * // Display the template
         * parent::display($tpl);
         */
    }
}