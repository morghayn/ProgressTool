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

    public function abc()
    {
        $this->input->set('active', 'ProjectBoard');

        parent::display();
    }

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