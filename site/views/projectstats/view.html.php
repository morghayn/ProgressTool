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
    protected $measurementCategories, $progressGoals, $measurements, $categories;

    /**
     * Renders view.
     *
     * @param null $tpl use default template.
     * @since 0.3.0
     */
    function display($tpl = null)
    {
        $model = parent::getModel();
        $this->measurementCategories = $model->getMeasurementCategories();
        $this->progressGoals = $model->getProgressGoals();
        $this->measurements = $model->getMeasurements();
        $this->categories = $model->getCategories();

        $this->addStylesheet();
        parent::display($tpl);
    }

    /**
     * // TODO: documentation
     * @since 0.2.6
     */
    private function addStylesheet()
    {
        $document = JFactory::getDocument();
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/masterChest.css");
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/optionsChest.css");
    }
}