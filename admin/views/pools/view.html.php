<?php defined('_JEXEC') or die;

/**
 * Class ProgressToolViewPools
 *
 * View for back-end pools functionality.
 *
 * @package ProgressTool
 * @subpackage admin
 * @since 0.5.0
 *
 * @author  Morgan Nolan <morgan.nolan@hotmail.com>
 * @link    https://github.com/morghayn
 */
class ProgressToolViewPools extends JViewLegacy
{
    /**
     * @var object list comprising of the country name and ID associated with each question pool.
     */
    protected $pools;

    /**
     * Renders view.
     *
     * @param string $tpl The name of the template file to parse; automatically searches through the template paths.
     * @since 0.5.0
     */
    function display($tpl = null)
    {
        $this->pools = $this->get('pools');

        parent::display($tpl);
        $this->prepareDocument();
    }

    /**
     * Prepares document by adding stylesheets and scripts.
     *
     * @since 0.5.0
     */
    private function prepareDocument()
    {
        $document = JFactory::getDocument();
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/admin/pools.css");
    }
}