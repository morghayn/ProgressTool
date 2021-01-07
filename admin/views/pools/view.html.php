<?php defined('_JEXEC') or die;

/**
 * (Admin) Class ProgressToolViewPool
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
     * @var array of pool objects.
     * @since 0.5.0
     */
    protected $pools;

    /**
     * Renders view.
     *
     * @param string $tpl
     * @since 0.5.0
     */
    function display($tpl = null)
    {
        $this->pools = $this->get('pools');

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
        $document->addScript(JURI::root() . "media/com_progresstool/css/admin/pools.css");
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/admin/pools.css");
    }
}