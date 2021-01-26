<?php defined('_JEXEC') or die;

/**
 * (Admin) Class ProgressToolViewTest
 *
 * View for back-end testing area.
 *
 * @package ProgressTool
 * @subpackage admin
 * @since 0.5.0
 *
 * @author  Morgan Nolan <morgan.nolan@hotmail.com>
 * @link    https://github.com/morghayn
 */
class ProgressToolViewTest extends JViewLegacy
{
    protected $categories, $progress;

    /**
     * Renders view.
     *
     * @param string $tpl
     * @since 0.5.0
     */
    function display($tpl = null)
    {
        $app = JFactory::getApplication();
        $input = $app->input;

        $model = parent::getModel();
        $this->categories = $model->getCategories($this->countryID, $this->projectID);
        $this->setProgress();

        $this->prepareDocument();
        parent::display($tpl);
    }

    /**
     * Calculates and sets the progress percentage of this progress for each category.
     *
     * @since 0.5.0
     */
    private function setProgress()
    {
        $this->progress = array();
        foreach ($this->categories as $category)
        {
            array_push(
                $this->progress,
                intval(($category->projectTotal / $category->categoryTotal) * 100)
            );
        }
    }

    /**
     * Prepares document by adding stylesheets and scripts.
     *
     * @since 0.5.0
     */
    private function prepareDocument()
    {
        $document = JFactory::getDocument();
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/admin.css");
        $document->addScript(JURI::root() . "media/com_progresstool/js/admin/adminBase.js");
        $document->addScript(JURI::root() . "media/com_progresstool/js/admin/test.js");
    }
}