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
    protected $categories, $progress, $progresses, $projects;

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

        $this->projects = $model->getProjects();
        $this->setProgress();
        var_dump($this->progresses);

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
        $model = parent::getModel();
        $this->progresses = array();

        foreach($this->projects as $projectID)
        {
            $this->categories = $model->getCategories(1, $projectID);
            $this->progress = array();
            foreach ($this->categories as $category)
            {
                array_push(
                    $this->progress,
                    intval(($category->projectTotal / $category->categoryTotal) * 100)
                );
            }

            array_push($this->progresses, $this->progress);
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
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/test.css");
        $document->addScript(JURI::root() . "media/com_progresstool/js/admin/adminBase.js");
        $document->addScript(JURI::root() . "media/com_progresstool/js/admin/test.js");
    }
}