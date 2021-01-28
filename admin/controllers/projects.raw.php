<?php defined('_JEXEC') or die;

/**
 * (Admin) Class ProgressToolControllerProjects
 *
 * Controller for back-end projects functionality.
 *
 * @package ProgressTool
 * @subpackage admin
 * @since 0.5.0
 *
 * @author  Morgan Nolan <morgan.nolan@hotmail.com>
 * @link    https://github.com/morghayn
 */
class ProgressToolControllerProjects extends JControllerLegacy
{
    public function getProjectEditorTable()
    {
        JSession::checkToken('get') or jexit(JText::_('JINVALID_TOKEN'));
        $input = JFactory::getApplication()->input;
        $projectID = $input->getInt('projectID', 0);
        echo $this->getTable($projectID);
    }

    public function getTable($projectID)
    {
        $model = $this->getModel('projects');
        $project = $model->getProjectForTable($projectID);
        $table = '<table>';
        foreach ($project as $key => $value):
            $table .= '<tr>';
            $table .= '</tr><td>' . $key . '</td>';
            $table .= '<td>' . $value . '</td>';
            $table .= '</tr>';
        endforeach;
        $table .= '</table>';
        return $table;
    }
}