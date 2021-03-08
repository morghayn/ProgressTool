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
class ProgressToolViewTimelinePlot extends JViewLegacy
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

        foreach ($this->projects as $project)
        {
            $projectProgress = $model->getProjectProgress($this->countryID, $project->id);
            foreach ($this->categories as $category)
            {
                array_push(
                    $plots,
                    array(
                        'project_name' => $project->name,
                        'colour_rgb' => $category->colour_rgb,
                        'icon_path' => $this->getProjectTypeIconPath($project->type),
                        'y' => rand($yPre[$category->id - 1], $yCur[$category->id]),
                        'x' => intval(($projectProgress[$category->id - 1]->projectTotal / $projectProgress[$category->id - 1]->categoryTotal) * 100)
                    )
                );
            }
        }

        return $plots;
    }

    public function getProjectTypeIconPath($type)
    {
        $path = "/media/com_progresstool/icons/";

        switch ($type)
        {
            case "Solar":
                $path .= "TypeIcon_Solar";
                break;
            case "Wind":
                $path .= "TypeIcon_Wind";
                break;
            case "Hydro":
                $path .= "TypeIcon_Hydro";
                break;
            case "Biomass":
                $path .= "TypeIcon_BioFuel";
                break;
        }

        return $path;
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