<?php defined('_JEXEC') or die;


abstract class getCountry
{
    /**
     * Returns the countryID associated with countryString, else if not found returns 1.
     *
     * @param string $countryString
     * @return int
     * @since 0.3.0
     */
    public static function findCountryID($countryString)
    {
        $db = JFactory::getDbo();
        $getCountryID = $db->getQuery(true);

        $getCountryID
            ->select($db->quoteName('C.id'))
            ->from($db->quoteName('#__pt_country', 'C'))
            ->where($db->quoteName('C.country') . ' LIKE ' . $db->quote($countryString));

        $countryID = $db->setQuery($getCountryID)->loadResult();
        return is_null($countryID) ? 1 : $countryID;
    }

    /**
     * Returns country index of the current user. This function is intended to be used in conjunction with JomSocial. If JomSocial is not present,
     * it will instead return 0.
     *
     * @return int
     * @since 0.5.0
     */
    public static function getCountryID()
    {
        if (class_exists('CFactory'))
        {
            JFactory::getLanguage()->load('com_community.country', JPATH_SITE, 'en-GB', true);
            $profileCountry = CFactory::getUser()->getInfo('FIELD_COUNTRY');

            $country = JText::_($profileCountry);
            return self::findCountryID($country);
        }
        else // for testing purposes
        {
            $country = "Universal";
            return self::findCountryID($country);
            // TODO: return 0 once testing is complete.
        }
    }
}