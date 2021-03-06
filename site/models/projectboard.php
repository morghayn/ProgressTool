<?php defined('_JEXEC') or die;

/**
 * (Site) Class ProgressToolModelProjectBoard
 *
 * Model for front-end projectboard functionality.
 *
 * @package ProgressTool
 * @subpackage site
 * @since 0.1.6
 *
 * @author  Morgan Nolan <morgan.nolan@hotmail.com>
 * @link    https://github.com/morghayn
 */
class ProgressToolModelProjectBoard extends JModelItem
{
    /**
     * Retrieves a project by ID.
     *
     * @param int $projectID ID of the project.
     * @return object project object.
     * @since 0.5.0
     */
    public function getProject($projectID)
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        $columns = array('P.id', 'P.user_id', 'P.name', 'P.description', 'T.type', 'P.activated');

        $query
            ->select($db->quoteName($columns))
            ->from($db->quoteName('#__pt_project', 'P'))
            ->innerjoin($db->quoteName('#__pt_project_type', 'T') . ' ON P.type_id = T.id')
            ->where($db->quoteName('P.id') . ' = ' . $db->quote($projectID))
            ->setLimit(1);

        return $db->setQuery($query)->loadObject();
    }

    /**
     * Retrieves all projects belonging to a user.
     *
     * @param int $userID ID of the user.
     * @return mixed object list of all projects belonging to the user.
     * @since 0.1.6
     */
    public function getProjects($userID)
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        $columns = array('P.id', 'P.name', 'P.description', 'T.type', 'P.activated');

        $query
            ->select($db->quoteName($columns))
            ->from($db->quoteName('#__pt_project', 'P'))
            ->leftjoin($db->quoteName('#__community_groups_members', 'CGM') . ' ON P.group_id = CGM.groupid')
            ->innerjoin($db->quoteName('#__pt_project_type', 'T') . ' ON P.type_id = T.id')
            ->where(
                $db->quoteName('P.user_id') . ' = ' . $db->quote($userID),
            )
            ->orwhere(array(
                $db->quoteName('CGM.memberid') . ' = ' . $db->quote($userID),
                $db->quoteName('CGM.permissions') . ' = 1'
            ))
            ->andwhere($db->quoteName('P.deactivated') . ' != 1')
            ->group($db->quoteName('P.id'))
            ->order('P.id DESC');
        /*
         * Note: for some reason the queries return duplicates on the production site not on my local site
         * So we must group by projectID to avoid duplicates. I am not aware what is causing this duplication
         */

        return $db->setQuery($query)->loadObjectList();
    }

    /**
     * Returns approval selections made by all inactive projects associated with a user.
     *
     * @param int $userID
     * @return array
     * @since 0.5.5
     */
    public function getSelections($userID)
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        $query
            ->select(array('P.id', 'A.approval_id'))
            ->from($db->quoteName('#__pt_project', 'P'))
            ->leftJoin($db->quoteName('#__pt_project_approval') . ' AS A ON P.id = A.project_id')
            ->leftjoin($db->quoteName('#__community_groups_members', 'CGM') . ' ON P.group_id = CGM.groupid')
            ->where(
                array(
                    $db->quoteName('P.activated') . ' = 0',
                    $db->quoteName('user_id') . ' = ' . $db->quote($userID)
                )
            )
            ->orWhere(
                array(
                    $db->quoteName('P.activated') . ' = 0',
                    $db->quoteName('CGM.memberid') . ' = ' . $db->quote($userID),
                    $db->quoteName('CGM.permissions') . ' = 1'
                )
            );
        /*
         * Note: for some reason the queries return duplicates on the production site not on my local site
         * So we must group by projectID to avoid duplicates. I am not aware what is causing this duplication
         */

        $rows = $db->setQuery($query)->loadObjectList();
        $grouped = array();

        foreach ($rows as $row)
        {
            $grouped[$row->id][$row->approval_id] = 1;
        }

        return $grouped;
    }

    /**
     * Retrieves approval questions.
     *
     * @return object list of all approval questions.
     * @since 0.2.6
     */
    public function getApprovalQuestions()
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        $columns = array('id', 'question');

        $query
            ->select($db->quoteName($columns))
            ->from($db->quoteName('#__pt_approval_question'));

        return $db->setQuery($query)->loadObjectList();
    }

    /**
     * Processes approval selections. Inserts selection if selection does not exist, else removes selection.
     *
     * @param int $projectID ID of the project.
     * @param int $approvalID ID of the approval question.
     * @return bool
     * @since 0.3.0
     */
    public function processSelection($projectID, $approvalID)
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $delete = $db->getQuery(true);
        $insert = $db->getQuery(true);

        $query
            ->select('COUNT(*)')
            ->from($db->quoteName('#__pt_project_approval'))
            ->where(array(
                $db->quoteName('project_id') . ' = ' . $db->quote($projectID),
                $db->quoteName('approval_id') . ' = ' . $db->quote($approvalID)
            ))
            ->setLimit(1);

        // If selection exists, delete it.
        if ($db->setQuery($query)->loadResult())
        {
            $delete
                ->delete($db->quoteName('#__pt_project_approval'))
                ->where(array(
                    $db->quoteName('project_id') . ' = ' . $db->quote($projectID),
                    $db->quoteName('approval_id') . ' = ' . $db->quote($approvalID)
                ));

            $db->setQuery($delete)->execute();
        } // If selection does not exist, insert it.
        else
        {
            $columns = array('project_id', 'approval_id');
            $values = array($projectID, $approvalID);

            $insert
                ->insert($db->quoteName('#__pt_project_approval'))
                ->columns($db->quoteName($columns))
                ->values(implode(',', $values));

            $db->setQuery($insert)->execute();
        }

        return $this->isProjectApproved($projectID);
    }

    /**
     * Checks if project meets approval criteria.
     *
     * @param int $projectID ID of the project.
     * @return boolean returns true if project meets criteria, else returns false.
     * @since 0.5.0
     */
    public function isProjectApproved($projectID)
    {
        $db = JFactory::getDbo();
        $countQuestions = $db->getQuery(true);
        $countSelections = $db->getQuery(true);

        $countQuestions
            ->select('COUNT(*)')
            ->from($db->quoteName('#__pt_approval_question'));

        $countSelections
            ->select('COUNT(*)')
            ->from($db->quoteName('#__pt_project_approval'))
            ->where($db->quoteName('project_id') . ' = ' . $db->quote($projectID));

        $numberOfQuestions = $db->setQuery($countQuestions)->loadResult();
        $numberOfSelections = $db->setQuery($countSelections)->loadResult();

        return ($numberOfQuestions == $numberOfSelections) ? $this->activateProject($projectID) : false;
    }

    /**
     * Activates a project.
     *
     * @param int $projectID ID of the project.
     * @return boolean returns true if project activation is successful, else returns false.
     * @since 0.3.0
     */
    public function activateProject($projectID)
    {
        $db = JFactory::getDbo();
        $update = $db->getQuery(true);
        $delete = $db->getQuery(true);

        $delete
            ->delete($db->quoteName('#__pt_project_approval'))
            ->where($db->quoteName('project_id') . ' = ' . $projectID);

        if ($db->setQuery($delete)->execute())
        {
            $update
                ->update($db->quoteName('#__pt_project'))
                ->set($db->quoteName('activated') . ' = 1')
                ->where($db->quoteName('id') . ' = ' . $db->quote($projectID));

            // If activation is a success, return true.
            return $db->setQuery($update)->execute();
        }

        // If activation fails, return false.
        return false;
    }
}