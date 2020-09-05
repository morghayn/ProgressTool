<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_progresstool
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */


// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * HelloWorld View
 * This is the site view presenting the user with the ability to add a new Helloworld record
 *
 */
class ProgressToolViewProjectCreate extends JViewLegacy
{
    protected $form = null;

    /**
     * Display the Hello World view
     *
     * @param string $tpl The name of the layout file to parse.
     *
     * @return  void
     */
    public function display($tpl = null)
    {
        // Get the form to display
        $this->form = $this->get('Form');

        // Call the parent display to display the layout file
        parent::display($tpl);

        // Set properties of the html document
        $this->prepareDocument();
    }

    /**
     * Prepares document by adding stylesheets and scripts.
     *
     * @since 0.5.0
     */
    protected function prepareDocument()
    {
        $document = JFactory::getDocument();
        $document->addScript(JURI::root() . "media/com_progresstool/forms/submitbutton.js");
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/projectcreate.css");
    }
}