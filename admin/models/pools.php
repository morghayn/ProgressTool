<?php defined('_JEXEC') or die;

/**
 * (Admin) Class ProgressToolModelPools
 *
 * Model for back-end question pools functionality.
 *
 * @package ProgressTool
 * @subpackage admin
 * @since 0.5.0
 *
 * @author  Morgan Nolan <morgan.nolan@hotmail.com>
 * @link    https://github.com/morghayn
 */
class ProgressToolModelPools extends JModelLegacy
{
    public function getPools()
    {
        $db = JFactory::getDbo();
        $getCountries = $db->getQuery(true);

        $getCountries
            ->select('*')
            ->from($db->quoteName('#__pt_country'));

        return $db->setQuery($getCountries)->loadObjectList();
    }
}