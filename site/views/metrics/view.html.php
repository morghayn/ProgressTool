<?php defined('_JEXEC') or die;

/**
 * (Site) Class ProgressToolViewMetrics
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
class ProgressToolViewMetrics extends JViewLegacy
{
    /**
     * @var integer identifier for the country associated with the current user.
     * @var integer identifier for the project.
     * @var array of task objects.
     * @var array of category objects.
     * @var array of progress percentages for each category of the progress tool.
     *
     * @since 0.5.0
     */
    protected $countryID, $projectID, $tasks, $categories, $progress;

    /**
     * Renders view.
     *
     * @param null $tpl use default template.
     * @since 0.3.0
     */
    function display($tpl = null)
    {
        $input = JFactory::getApplication()->input;
        $this->projectID = $input->getInt('projectID', 0);

        // Authorizing user access for projectID
        JLoader::register('Auth', JPATH_BASE . '/components/com_progresstool/helpers/Auth.php');
        Auth::authorize($this->projectID);

        // Retrieving countryID for the current user
        JLoader::register('getCountry', JPATH_BASE . '/components/com_progresstool/helpers/getCountry.php');
        $this->countryID = getCountry::getCountryID();

        $model = parent::getModel();
        $this->tasks = $model->getTasks($this->countryID, $this->projectID);
        $this->categories = $model->getCategories($this->countryID, $this->projectID);
        $this->setProgress();

        $this->prepareDocument();
        parent::display($tpl);
    }

    /**
     * Prepares document by adding stylesheets and scripts.
     *
     * @since 0.5.0
     */
    private function prepareDocument()
    {
        $document = JFactory::getDocument();
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/site/metrics.css");
        $document->addScript(JURI::root() . "media/com_progresstool/js/site/metrics.js");
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
}