<?php defined('_JEXEC') or die;

/**
 * Class ProgressToolViewProjectStats
 *
 * View for front-end project stats functionality.
 *
 * @package ProgressTool
 * @subpackage site
 * @since 0.3.0
 *
 * @author  Morgan Nolan <morgan.nolan@hotmail.com>
 * @link    https://github.com/morghayn
 */
class ProgressToolViewProjectStats extends JViewLegacy
{
    /**
     * @var
     * @var
     * @var
     * @var
     */
    protected $tasks, $categories;

    /**
     * Renders view.
     *
     * @param null $tpl use default template.
     * @since 0.3.0
     */
    function display($tpl = null)
    {
        $model = parent::getModel();
        $this->tasks = $model->getTasks();
        $this->categories = $model->getCategories();

        $this->addStylesheet();
        $this->addScripts();
        parent::display($tpl);
    }

    /**
     * // TODO: documentation
     * @since 0.3.0
     */
    private function addStylesheet()
    {
        $document = JFactory::getDocument();
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/masterChest.css");
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/projectStats.css");
    }

    /**
     * // TODO: documentation
     * @since 0.3.0
     */
    private function addScripts()
    {
        $document = JFactory::getDocument();
        $document->addScript(JURI::root() . "media/com_progresstool/js/projectstats.js");
    }
}