<?php defined('_JEXEC') or die;

/**
 * (Site) Class ProgressToolModelStatistics
 *
 * Model for front-end statistics functionality.
 *
 * @package ProgressTool
 * @subpackage site
 * @since 0.5.5
 *
 * @author  Morgan Nolan <morgan.nolan@hotmail.com>
 * @link    https://github.com/morghayn
 */
class ProgressToolModelStatistics extends JModelItem
{
    public function getStatistics()
    {
        $data = array();
        $data['data']['projectCount'] = $this->getProjectCount();
        return $data;
    }

    public function getProjectCount()
    {
        $db = JFactory::getDbo();
        $getProjectCount = $db->getQuery(true);

        $getProjectCount
            ->select('COUNT(*)')
            ->from($db->quoteName('#__pt_project'));

        return $db->setQuery($getProjectCount)->loadResult();
    }
}
