<?php defined('_JEXEC') or die;


abstract class Authenticator
{
    /**
     * Returns a boolean to indicate whether a project actually exists. True means it does and false means it does not.
     *
     * @param int $projectID the ID of the project in which a check will be done.
     * @return bool to indicate whether project exists.
     * @since 0.5.0
     */
    public static function projectExists($projectID)
    {
        $db = JFactory::getDbo();
        $getProject = $db->getQuery(true);

        $getProject->select($db->quoteName('P.id'))
            ->from($db->quoteName('#__pt_project', 'P'))
            ->where($db->quoteName('P.id') . ' = ' . $db->quote($projectID));

        return $db->setQuery($getProject)->loadResult() != null;
    }

    /**
     * Checks if user should have access to the project
     *
     * @param int $userID the ID of the user
     * @param int $projectID the ID of the project.
     * @since 0.5.0
     */
    public static function hasAccess($userID, $projectID)
    {
        $db = JFactory::getDbo();
        $checkAccess = $db->getQuery(true);

        // conditions for the query.
        $where =
            array(
                $db->quoteName('P.id') . ' = ' . $db->quote($projectID),
                $db->quoteName('P.user_id') . ' = ' . $db->quote($userID)
            );
        $orwhere =
            array(
                $db->quoteName('P.id') . ' = ' . $db->quote($projectID),
                $db->quoteName('CGM.memberid') . ' = ' . $db->quote($userID),
                $db->quoteName('CGM.permissions') . ' = 1'

            );

        $checkAccess
            ->select('IF(COUNT(P.id) < 1, 0, 1) AS status')
            ->from($db->quoteName('#__pt_project', 'P'))
            ->leftjoin($db->quoteName('#__community_groups_members', 'CGM') . ' ON ' . $db->quoteName('P.group_id') . ' = ' . $db->quoteName('CGM.groupid'))
            ->where($where)
            ->orwhere($orwhere);

        //-- 1 = access granted //-- 0 = access denied
        return $db->setQuery($checkAccess)->loadResult() == 1;
    }

    public static function redirectGuests()
    {
        $user = JFactory::getUser();
        $guestRedirectMessage = 'You must be logged in to use the Progress Tool.';

        // If user is guest.
        if ($user->get('guest'))
        {
            $return = urlencode(base64_encode('index.php?option=com_progresstool&view=projectboard'));
            JFactory::getApplication()->redirect(
                'index.php?option=com_users&view=login&return=' . $return,
                $guestRedirectMessage
            );
        }
    }

    public static function authenticate($projectID)
    {
        $user = JFactory::getUser();

        $guestRedirectMessage = 'You must be logged in to use the Progress Tool.';
        $genericErrorMessage = 'Project authentication failed. Please contact the sites administrator.';

        // If user is guest.
        self::redirectGuests();

        // If project does not exist.
        if (!self::projectExists($projectID))
        {
            JFactory::getApplication()->redirect(
                JRoute::_('index.php?option=com_progresstool&view=projectboard', $genericErrorMessage), $genericErrorMessage
            );
        }
        // If user should does not have rights to access the project.
        elseif (!self::hasAccess($user->id, $projectID))
        {
            JFactory::getApplication()->redirect(
                JRoute::_('index.php?option=com_progresstool&view=projectboard', $genericErrorMessage), $genericErrorMessage
            );
        }
    }
}