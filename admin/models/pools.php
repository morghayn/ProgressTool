<?php defined('_JEXEC') or die;

/**
 * Class ProgressToolModelPools
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
    /**
     * Returns country data associated with each question pool Countries are what I refer to as question pools.
     * Each country / question pool has numerous questions associated via pt_question_country.
     *
     * @return object list of pools.
     */
    public function getPools()
    {
        $db = JFactory::getDbo();
        $getCountries = $db->getQuery(true);

        $getCountries
            ->select('*')
            ->from($db->quoteName('#__pt_country'));

        return $db->setQuery($getCountries)->loadObjectList();
    }

    public function createPool($data)
    {

    }

    public function updatePool($data)
    {

    }

    public function deletePool($data)
    {

    }
}