<?php defined('_JEXEC') or die;

/**
 * Class ProgressToolViewProjectBoard
 *
 * Handling JSON responses for AJAX requests client-side
 *
 * @package ProgressTool
 * @subpackage site
 * @since 0.1.5
 *
 * @author  Morgan Nolan <morgan.nolan@hotmail.com>
 * @link    https://github.com/morghayn
 * @license GNU General Public License version 2 or later; see LICENSE.txt
 */
class ProgressToolViewProjectBoard extends JViewLegacy
{

    /**
     * Returns JSON test response
     *
     * @param null $tpl use default template.
     * @since 0.1.2
     */
    function display($tpl = null)
    {
        echo new JResponseJson("Success I believe");
    }
}