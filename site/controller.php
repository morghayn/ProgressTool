<?php defined('_JEXEC') or die;

/**
 * Class ProgressToolController
 *
 * Main component controller for the component's front-end.
 *
 * @package ProgressTool
 * @subpackage site
 * @since 0.0.1
 *
 * @author  Morgan Nolan <morgan.nolan@hotmail.com>
 * @link    https://github.com/morghayn
 */
class ProgressToolController extends JControllerLegacy
{

    // TODO since 0.2.6/
    public function persistClick()
    {
        if (!JSession::checkToken('get'))
        {
            echo new JResponseJson(null, JText::_('JINVALID_TOKEN'), true);
        }
        else
        {
            parent::display();
        }
    }

    // TODO 0.2.6
    public function createProject()
    {
        if (!JSession::checkToken('get'))
        {
            echo new JResponseJson(null, JText::_('JINVALID_TOKEN'), true);
        }
        else
        {
            parent::display();
        }
    }

    // TODO 0.2.6
    public function openSurvey()
    {
        if (!JSession::checkToken('get'))
        {
            echo new JResponseJson(null, JText::_('JINVALID_TOKEN'), true);
        }
        else
        {
            $input = JFactory::getApplication()->input;
            $data = $input->get('data', array(), 'ARRAY');

            $projectID = urlencode(base64_encode($data['projectID']));
            $surveyRedirect = 'index.php?option=com_progresstool&view=survey&projectID=' . $projectID;
            $response = array("redirect" => $surveyRedirect);
            echo new JResponseJson($response);
        }
    }

    public function approval()
    {
        if (!JSession::checkToken('get'))
        {
            echo new JResponseJson(null, JText::_('JINVALID_TOKEN'), true);
        }
        else
        {
            parent::display();
        }
    }
}



/*
            $input = JFactory::getApplication()->input;
            $data = $input->get('data', array(), 'ARRAY');

            if($data['projectID'])
            {
                $projectID = urlencode(base64_encode($data['projectID']));
                $surveyRedirect = 'index.php?option=com_progresstool&view=survey&projectID=' . $projectID;
                $response = array("redirect"=>$surveyRedirect);
                echo new JResponseJson($response);
            }
            else
            {
                parent::display();
            }
 */