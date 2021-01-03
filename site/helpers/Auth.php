<?php defined('_JEXEC') or die;


abstract class Auth
{
    /**
     * Authorize user.
     *
     * @param $projectID
     * @throws Exception
     * @since 0.5
     */
    public static function authorize($projectID)
    {
        $genericErrorMessage = 'Project authentication failed. Please contact the sites administrator.';
        $user = JFactory::getUser();

        // Redirect if guest
        self::redirectGuests();

        if (!self::projectExists($projectID))
        {
            // Redirect if project does not exist
            JFactory::getApplication()->redirect(
                JRoute::_('index.php?option=com_progresstool&view=projectboard', $genericErrorMessage), $genericErrorMessage
            );
        }
        elseif (!self::hasAccess($user->id, $projectID))
        {
            // Redirect if user does not have permission to access
            JFactory::getApplication()->redirect(
                JRoute::_('index.php?option=com_progresstool&view=projectboard', $genericErrorMessage), $genericErrorMessage
            );
        }
    }

    /**
     * Redirects guests.
     * @since 0.5
     */
    public static function redirectGuests()
    {
        if (JFactory::getUser()->get('guest'))
        {
            $return = urlencode(base64_encode('index.php?option=com_progresstool&view=projectboard'));
            JFactory::getApplication()->redirect(
                'index.php?option=com_users&view=login&return=' . $return,
                'You must be logged in to use the Progress Tool.'
            );
        }
    }

    /**
     * Returns true if project exists, returns false if it cannot be found
     *
     * @param int $projectID
     * @return bool
     * @since 0.5
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
     * Returns true if user has permission, returns false if user does not.
     *
     * @param int $userID
     * @param int $projectID
     * @return bool
     * @since 0.5
     */
    public static function hasAccess($userID, $projectID)
    {
        $db = JFactory::getDbo();
        $checkAccess = $db->getQuery(true);

        // conditions for the query.
        $where = array(
            $db->quoteName('P.id') . ' = ' . $db->quote($projectID),
            $db->quoteName('P.user_id') . ' = ' . $db->quote($userID)
        );
        $orWhere = array(
            $db->quoteName('P.id') . ' = ' . $db->quote($projectID),
            $db->quoteName('CGM.memberid') . ' = ' . $db->quote($userID),
            $db->quoteName('CGM.permissions') . ' = 1'
        );

        $checkAccess
            ->select('IF(COUNT(P.id) < 1, 0, 1) AS status')
            ->from($db->quoteName('#__pt_project', 'P'))
            ->leftjoin($db->quoteName('#__community_groups_members', 'CGM') . ' ON ' . $db->quoteName('P.group_id') . ' = ' . $db->quoteName('CGM.groupid'))
            ->where($where)
            ->orwhere($orWhere);

        return $db->setQuery($checkAccess)->loadResult() == 1;
    }
}