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
 * @license GNU General Public License version 2 or later; see LICENSE.txt
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
        // Todo not this type of redirect
        $this->user = JFactory::getUser();


        $input = JFactory::getApplication()->input;
        $data = $input->get('data', array(), 'ARRAY');

        if($data['projectID'])
        {
            $projectID = urlencode(base64_encode($data['projectID']));
            $surveyRedirect = 'index.php?option=com_progresstool&view=survey&projectID=' . $projectID;
            $respon = array("redirect"=>$surveyRedirect);
            //JFactory::getApplication()->redirect(JRoute::_($respon, false));
            echo new JResponseJson($respon);
        }
        else
        {
            echo new JResponseJson('No projectID received');
        }

        /*
        $redirect_url = 'index.php?option=com_progresstool&view=projectboard';
        JFactory::getApplication()->redirect(JRoute::_($redirect_url, false));
        */

    }
}