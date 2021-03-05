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
    protected $categories, $projects, $plots;
    private $countryID;

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
        $userID = JFactory::getUser()->id;

        // Retrieving countryID for the current user
        JLoader::register('getCountry', JPATH_BASE . '/components/com_progresstool/helpers/getCountry.php');
        $this->countryID = getCountry::getCountryID();

        $this->categories = $model->getCategories();
        $this->projects = $model->getProjects($userID);
        $this->plots = $this->getPlots();

        $this->prepareDocument();
        parent::display($tpl);
    }

    /**
     * Calculates the y and x plots for each project.
     *
     * @since 0.5.0
     */
    private function getPlots()
    {
        $model = parent::getModel();
        $yPre = array(11, 44.5, 70, 99.5);
        $yCur = array(11, 40.0, 65, 94);
        $plots = array();

        foreach($this->projects as $projectID)
        {
            $projectProgress = $model->getProjectProgress($this->countryID, $projectID);
            foreach ($this->categories as $category)
            {
                $categoryProjectProgress = ($projectProgress[$category->id - 1]);
                array_push(
                    $plots,
                    array(
                        // Getting vertical plot
                        rand($yPre[$category->id - 1], $yCur[$category->id]),

                        // Getting horizontal plot
                        intval(($categoryProjectProgress->projectTotal / $categoryProjectProgress->categoryTotal) * 100),

                        // Color RGB
                        $category->colour_rgb
                    )
                );
            }
        }

        return $plots;
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
        $document->addScript(JURI::root() . "media/com_progresstool/js/admin/admin.css");
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/test.css");
        $document->addScript(JURI::root() . "media/com_progresstool/js/site/test.js");
    }
}