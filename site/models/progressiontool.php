<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_progressiontool
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * ProgressionTool Model
 *
 * @since  0.0.1
 */
class ProgressionToolModelProgressionTool extends JModelItem
{
    /**
     * @var string message
     */
    protected $message;

    /**
     * Get the message
     *
     * @return  string  The message to be displayed to the user
     */
    public function getMsg()
    {
        if (!isset($this->message))
        {
            $jinput = JFactory::getApplication()->input;
            $id     = $jinput->get('id', 1, 'INT');

            switch ($id)
            {
                case 2:
                    $this->message = 'Good Bye World!';
                    break;
                default:
                case 1:
                    $this->message = 'Hello World!';
                    break;
            }
        }
        return $this->message;
    }
}