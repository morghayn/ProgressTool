<?php defined('_JEXEC') or die;
/**
 * Entry-point for component's back-end.
 *
 * @package ProgressTool
 * @subpackage admin
 * @since 0.0.1
 *
 * @author  Morgan Nolan <morgan.nolan@hotmail.com>
 * @link    https://github.com/morghayn
 */

// Set some global property
$document = JFactory::getDocument();

// Get an instance of the controller prefixed by ProgressTool
$controller = JControllerLegacy::getInstance('ProgressTool');

// Perform the Request task
$controller->execute(JFactory::getApplication()->input->get('task'));

// Redirect if set by the controller
$controller->redirect();