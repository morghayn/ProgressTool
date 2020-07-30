<?php defined('_JEXEC') or die;
/**
 * Entry-point for component's front-end.
 *
 * @package ProgressTool
 * @subpackage site
 * @since 0.0.1
 *
 * @author  Morgan Nolan <morgan.nolan@hotmail.com>
 * @link    https://github.com/morghayn
 * @license GNU General Public License version 2 or later; see LICENSE.txt
 */

// Get an instance of the controller prefixed by ProgressTool
$controller = JControllerLegacy::getInstance('ProgressTool');

// Perform the Request task
$input = JFactory::getApplication()->input; // do I need this?
$controller->execute($input->getCmd('task'));

// Redirect if set by the controller
$controller->redirect();