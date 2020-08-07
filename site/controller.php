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
 * @license GNU General Public License version 2 or later; see LICENSE.txt
 */
class ProgressToolController extends JControllerLegacy
{

    // todo comment here since 1.7 for survey_site
    public function jsponse()
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

    // TODO REMOVE AFTER TESTING is complete
    public function mapsearch()
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