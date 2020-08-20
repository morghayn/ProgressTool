<?php defined('_JEXEC') or die;

/**
 * Class ProgressToolViewProjectBoard
 *
 * Handling JSON responses for AJAX requests client-side
 *
 * @package ProgressTool
 * @subpackage site
 * @since 0.2.6
 *
 * @author  Morgan Nolan <morgan.nolan@hotmail.com>
 * @link    https://github.com/morghayn
 */
class ProgressToolViewProjectBoard extends JViewLegacy
{

    /**
     * Returns JSON test response //todo proper description
     *
     * @param null $tpl use default template.
     * @since 0.2.6
     */
    function display($tpl = null)
    {
        $input = JFactory::getApplication()->input;
        $data = $input->get('data', array(), 'ARRAY');
        $projectID = $data['project'];
        $approvalID = $data['approvalID'];

        $model = parent::getModel();
        $model->processSelection($projectID, $approvalID);
        if ($model->isProjectApproved($projectID))
            $isActivated = $model->activateProject($projectID);

        echo new JResponseJson($isActivated);

        /**
         * if ($isActivated)
         * {
         * JFactory::getApplication()->redirect('index.php?option=com_progresstool&view=projectboard');
         * }
         */
    }
}