<?php defined('_JEXEC') or die;

/**
 * (Site) Class ProgressToolControllerStatistics
 *
 * Controller for back-end statistics functionality.
 *
 * @package ProgressTool
 * @subpackage admin
 * @since 0.5.5
 *
 * @author  Morgan Nolan <morgan.nolan@hotmail.com>
 * @link    https://github.com/morghayn
 */
class ProgressToolControllerStatistics extends JControllerLegacy
{
    public function getStatistics()
    {

        $model = $this->getModel('statistics');
        $statistics = $model->getStatistics();

        echo json_encode($statistics);
    }
}
